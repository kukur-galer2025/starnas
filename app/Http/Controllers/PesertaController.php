<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Abstrak;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Support\NotifPeserta;
use App\Models\Notifikasi;

class PesertaController extends Controller
{
    public function beranda()
    {
        $user = Auth::user();
        $pembayaran = Pembayaran::where('user_id', $user->id)->latest()->first();

        return view('peserta.beranda', compact('pembayaran'));
    }

    /**
     * Ringkasan status terkini, dipoll oleh browser agar tampilan peserta
     * langsung mengikuti perubahan dari admin tanpa refresh manual.
     */
    public function statusSinkron()
    {
        $userId = Auth::id();
        $abstrak = Abstrak::where('user_id', $userId)->latest()->first();
        $pembayaran = Pembayaran::where('user_id', $userId)->latest()->first();

        return response()->json([
            'abstrak' => $abstrak ? $abstrak->status_abstrak . '|' . $abstrak->updated_at?->timestamp : 'none',
            'pembayaran' => $pembayaran ? $pembayaran->status . '|' . $pembayaran->updated_at?->timestamp : 'none',
        ])->header('Cache-Control', 'no-store, max-age=0');
    }

    /**
     * Daftar notifikasi terbaru + jumlah yang belum dibaca (dipoll lonceng).
     */
    public function notifikasi(Request $request)
    {
        $belumDibaca = Notifikasi::where('user_id', Auth::id())->whereNull('dibaca_at')->count();
        $versi = $belumDibaca . '-' . (Notifikasi::where('user_id', Auth::id())->max('id') ?? 0);

        // Mode cek cepat: hanya penanda versi, tanpa daftar (dipanggil sering oleh lonceng).
        if ($request->boolean('cek')) {
            return response()->json(['belum_dibaca' => $belumDibaca, 'versi' => $versi])
                ->header('Cache-Control', 'no-store, max-age=0');
        }

        $items = Notifikasi::where('user_id', Auth::id())->latest()->take(15)->get();

        return response()->json([
            'belum_dibaca' => $belumDibaca,
            'versi' => $versi,
            'items' => $items->map(fn ($n) => [
                'id' => $n->id,
                'judul' => $n->judul,
                'pesan' => $n->pesan,
                'waktu' => $n->created_at->diffForHumans(),
                'baru' => is_null($n->dibaca_at),
                'url' => route('peserta.notifikasi.buka', $n->id),
            ]),
        ])->header('Cache-Control', 'no-store, max-age=0');
    }

    public function bacaSemuaNotifikasi()
    {
        Notifikasi::where('user_id', Auth::id())->whereNull('dibaca_at')->update(['dibaca_at' => now()]);

        return response()->json(['ok' => true]);
    }

    public function bukaNotifikasi(Notifikasi $notifikasi)
    {
        abort_if($notifikasi->user_id !== Auth::id(), 403);

        if (is_null($notifikasi->dibaca_at)) {
            $notifikasi->update(['dibaca_at' => now()]);
        }

        return redirect($notifikasi->url ?: route('peserta.riwayat'));
    }

    public function caraPembayaran()
    {
        $user = Auth::user();
        $pembayaran = Pembayaran::where('user_id', $user->id)->latest()->first();

        return view('peserta.pembayaran_cara', compact('pembayaran'));
    }

    /**
     * Kategori pemakalah baru boleh dibayar setelah abstrak diterima.
     * Kategori non-presenter tidak wajib abstrak. Peserta yang sudah punya
     * data pembayaran (data lama) tidak dibatasi.
     */
    private function bolehBayarPemakalah(): bool
    {
        $userId = Auth::id();

        if (Pembayaran::where('user_id', $userId)->exists()) {
            return true;
        }

        return Abstrak::where('user_id', $userId)->where('status_abstrak', 'diterima')->exists();
    }

    public function uploadBukti()
    {
        $user = Auth::user();
        $pembayaran = Pembayaran::where('user_id', $user->id)->latest()->first();
        $bolehPemakalah = $this->bolehBayarPemakalah();

        return view('peserta.pembayaran_upload', compact('pembayaran', 'bolehPemakalah'));
    }

    public function storeBukti(Request $request)
    {
        try {
            $valid_categories = [
                'asasi_onsite', 'umum_onsite', 'mahasiswa_onsite',
                'asasi_online', 'umum_online', 'mahasiswa_online',
                'non-presenter'
            ];

            $request->validate([
                'kategori_pembayaran' => ['required', 'string', Rule::in($valid_categories)],
                'nomor_anggota_asasi' => [
                    Rule::requiredIf(function () use ($request) {
                        return in_array($request->input('kategori_pembayaran'), ['asasi_onsite', 'asasi_online']);
                    }),
                    'nullable', 'string', 'max:255'
                ],
                'bukti_bayar' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            ]);

            $harga = [
                'asasi_onsite' => 450000, 'umum_onsite' => 500000, 'mahasiswa_onsite' => 250000,
                'asasi_online' => 250000, 'umum_online' => 300000, 'mahasiswa_online' => 150000,
                'non-presenter' => 100000
            ];

            $kategori = $request->input('kategori_pembayaran');
            if (!isset($harga[$kategori])) {
                throw new \Exception("Kategori pembayaran tidak valid.");
            }

            if ($kategori !== 'non-presenter' && !$this->bolehBayarPemakalah()) {
                return redirect()->route('peserta.abstrak.upload')
                    ->with('error', 'Kategori pemakalah: silakan upload abstrak terlebih dahulu. Pembayaran dapat dilakukan setelah abstrak Anda diterima.');
            }

            $nominal = $harga[$kategori];
            $pembayaran = Pembayaran::where('user_id', Auth::id())->first();

            if ($pembayaran && in_array($pembayaran->status, ['pending', 'verified'])) {
                return redirect()->route('peserta.riwayat')->with('error', 'Pembayaran sedang diproses atau sudah diverifikasi.');
            }

            // Hapus file lama jika ada
            if ($pembayaran && $pembayaran->bukti_path) {
                if (Storage::disk('public')->exists($pembayaran->bukti_path)) {
                    Storage::disk('public')->delete($pembayaran->bukti_path);
                }
            }

            $path = $request->file('bukti_bayar')->store('bukti_pembayaran', 'public');

            Pembayaran::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'bukti_path' => $path,
                    'status' => 'pending',
                    'catatan_admin' => null,
                    'kategori_pembayaran' => $kategori,
                    'nominal' => $nominal,
                    'nomor_anggota_asasi' => $request->input('nomor_anggota_asasi'),
                ]
            );

            NotifPeserta::kirim(Auth::user(), 'Bukti Pembayaran Diterima Sistem', 'Bukti pembayaran Anda sudah kami terima',
                ['Bukti pembayaran Anda berhasil diunggah dan sedang menunggu verifikasi admin.', 'Kami akan mengirim email lagi setelah proses verifikasi selesai.'],
                null, 'Lihat Riwayat Status', route('peserta.riwayat'));

            return redirect()->route('peserta.riwayat')->with('success', 'Bukti pembayaran berhasil diunggah. Konfirmasi dikirim ke email Anda, cek juga folder Spam.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('StoreBukti Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    /**
     * LIHAT BUKTI PEMBAYARAN (FIX HOSTING)
     */
    public function viewBuktiPembayaranPeserta(Pembayaran $pembayaran)
    {
        // Gunakan != (loose comparison) untuk user_id
        if ($pembayaran->user_id != Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        // Cek path storage default
        $filePath = storage_path('app/public/' . $pembayaran->bukti_path);

        // Fallback: Cek path public/storage jika symlink berbeda
        if (!file_exists($filePath)) {
            $filePathPublic = public_path('storage/' . $pembayaran->bukti_path);
            if (file_exists($filePathPublic)) {
                return response()->file($filePathPublic);
            }
            
            // Debugging log jika file tidak ketemu di kedua tempat
            Log::error("File bukti tidak ditemukan. Mencari di: $filePath DAN $filePathPublic");
            abort(404, 'File bukti pembayaran tidak ditemukan di server.');
        }

        return response()->file($filePath);
    }

    public function riwayat()
    {
        $user = Auth::user();
        $riwayat_pembayaran = Pembayaran::where('user_id', $user->id)->latest()->get();
        $abstraks = Abstrak::where('user_id', $user->id)->latest()->get();

        return view('peserta.riwayat', compact('riwayat_pembayaran', 'abstraks'));
    }

    public function editProfile()
    {
        $user = User::find(Auth::id()); // Force refresh data
        return view('peserta.profile_edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'nomor_handphone' => 'required|string|max:15',
            'provinsi' => 'required|string|max:255',
            'institusi' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['nama_lengkap', 'pekerjaan', 'jenis_kelamin', 'nomor_handphone', 'provinsi', 'institusi']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $sebelumnyaLengkap = $user->profilLengkap();

        $user->update($data);

        if (!$sebelumnyaLengkap && $user->profilLengkap()) {
            return redirect()->route('peserta.beranda')->with('success', 'Profil berhasil dilengkapi. Selamat datang!');
        }

        return redirect()->route('peserta.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * DOWNLOAD KWITANSI (FIX LOGO HILANG)
     */
    public function downloadKwitansi(Pembayaran $pembayaran)
    {
        $user = User::find(Auth::id()); // Force Refresh Data User

        if ($pembayaran->user_id != $user->id || $pembayaran->status !== 'verified') {
            return redirect()->route('peserta.riwayat')->with('error', 'Kwitansi tidak valid.');
        }

        // --- LOGIKA PENCARIAN LOGO MULTI-PATH ---
        // Mencari file starnas.png di berbagai kemungkinan lokasi di hosting
        $possiblePaths = [
            storage_path('app/public/starnas.png'),       // 1. Storage default
            public_path('storage/starnas.png'),           // 2. Public Link
            base_path('public_html/storage/starnas.png'), // 3. Public HTML (cPanel umum)
            $_SERVER['DOCUMENT_ROOT'] . '/storage/starnas.png' // 4. Document Root
        ];

        $logoUrl = ''; // Default kosong

        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                try {
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $logoUrl = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    break; // Berhenti jika sudah ketemu
                } catch (\Exception $e) {
                    Log::error("Gagal encode logo: " . $e->getMessage());
                }
            }
        }
        // -------------------------------------

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'chroot' => public_path(),
        ])->loadView('peserta.kwitansi_pdf', [
            'pembayaran' => $pembayaran,
            'user' => $user,
            'logoUrl' => $logoUrl
        ]);

        return $pdf->download('Kwitansi-STARNAS-' . $pembayaran->id . '.pdf');
    }

    public function generateSertifikat()
    {
        // FORCE REFRESH: AMBIL DATA FRESH DARI DB
        $user = User::find(Auth::id()); 

        $pembayaranVerified = Pembayaran::where('user_id', $user->id)
            ->where('status', 'verified')
            ->latest()
            ->first();

        if (!$pembayaranVerified) {
            return redirect()->route('peserta.riwayat')->with('error', 'Sertifikat tidak dapat diunduh. Pembayaran belum terverifikasi.');
        }

        $nomor_sertifikat_unik = 'ASASI01122026-' . str_pad($user->id, 4, '0', STR_PAD_LEFT);

        $abstrak = Abstrak::where('user_id', $user->id)->latest()->first();
        $peran_peserta = ($abstrak && $abstrak->status_abstrak == 'diterima') ? 'Presenter' : 'Peserta Seminar';

        $sertifikatData = [
            'nama_peserta' => $user->nama_lengkap, // Nama Terbaru
            'peran_peserta' => $peran_peserta,
            'nomor_unik' => $nomor_sertifikat_unik,
            'tanggal_acara' => '1 - 2 Desember 2026',
            'tempat_acara' => 'The Malioboro Hotel, Yogyakarta',
            'tema' => 'AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi',
        ];

        return view('peserta.sertifikat_preview', $sertifikatData);
    }

    public function uploadAbstrak()
    {
        $user = User::find(Auth::id());
        $abstraks = $user->abstraks()->latest()->get();
        $pembayaran = Pembayaran::where('user_id', $user->id)->latest()->first();
        $batasAbstrak = 3;
        $sudahMaksimal = $abstraks->count() >= $batasAbstrak;

        return view('peserta.upload_abstrak', compact('user', 'pembayaran', 'abstraks', 'sudahMaksimal', 'batasAbstrak'));
    }

    public function storeAbstrak(Request $request)
    {
        try {
            $user = Auth::user();
            $jumlahAbstrak = \App\Models\Abstrak::where('user_id', $user->id)->count();
            if ($jumlahAbstrak >= 3) {
                return redirect()->back()->with('error', 'Anda sudah mencapai batas maksimal 3 abstrak.');
            }

            $request->validate([
                'judul_abstrak' => 'required|string|max:255',
                'abstrak_file' => 'required|file|mimes:doc,docx,pdf|max:10240'
            ]);

            $file = $request->file('abstrak_file');
            $filePath = $file->storeAs('abstrak', 'abstrak_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension(), 'public');

            $abstrak = \App\Models\Abstrak::create([
                'user_id' => $user->id,
                'judul_abstrak' => $request->judul_abstrak,
                'file_abstrak_path' => $filePath,
                'file_abstrak_original_name' => $file->getClientOriginalName(),
                'status_abstrak' => 'pending',
                'catatan_reviewer_abstrak' => null,
            ]);

            NotifPeserta::kirim($user, 'Abstrak Berhasil Diupload', 'Abstrak Anda sudah kami terima',
                ['Abstrak berjudul "' . $abstrak->judul_abstrak . '" berhasil diunggah dan sedang menunggu review (3-7 hari kerja).', 'Pembayaran kategori pemakalah dapat dilakukan setelah abstrak diterima.'],
                null, 'Lihat Riwayat Status', route('peserta.riwayat'));

            return redirect()->route('peserta.abstrak.upload')->with('success', 'Abstrak berhasil diupload. Konfirmasi dikirim ke email Anda, cek juga folder Spam.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function downloadAbstrak(Abstrak $abstrak)
    {
        abort_if($abstrak->user_id !== Auth::id(), 403);

        if (!$abstrak->file_abstrak_path) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $filePath = storage_path('app/public/' . $abstrak->file_abstrak_path);

        if (!file_exists($filePath)) {
            $filePathPublic = public_path('storage/' . $abstrak->file_abstrak_path);
            if (file_exists($filePathPublic)) {
                return response()->download($filePathPublic, $abstrak->file_abstrak_original_name);
            }
            return redirect()->back()->with('error', 'File fisik tidak ditemukan di server.');
        }

        return response()->download($filePath, $abstrak->file_abstrak_original_name);
    }

    /**
     * Letter of Acceptance (PDF) untuk abstrak yang sudah diterima.
     */
    public function downloadLoa(Abstrak $abstrak)
    {
        $user = User::find(Auth::id());
        abort_if((int) $abstrak->user_id !== (int) $user->id, 403);

        if ($abstrak->status_abstrak !== 'diterima') {
            return redirect()->back()->with('error', 'LoA hanya tersedia untuk abstrak yang sudah diterima.');
        }

        $gambar = function (string $nama) {
            $path = resource_path('images/loa/' . $nama);
            return is_file($path) ? 'data:image/png;base64,' . base64_encode(file_get_contents($path)) : null;
        };

        // Tanggal surat = tanggal abstrak diterima (update terakhir oleh admin).
        $tanggal = ($abstrak->updated_at ?? now())->copy()->locale('id');
        $bulanRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'][$tanggal->month - 1];
        $idNaskah = 'STARNAS-2026-' . str_pad($abstrak->id, 4, '0', STR_PAD_LEFT);

        $pdf = Pdf::loadView('peserta.loa_pdf', [
            'nomorSurat' => str_pad($abstrak->id, 3, '0', STR_PAD_LEFT) . '/LoA/STARNAS-ASASI/' . $bulanRomawi . '/' . $tanggal->year,
            'namaPenulis' => $user->nama_lengkap,
            'afiliasi' => $user->institusi ?: '-',
            'idNaskah' => $idNaskah,
            'judulNaskah' => $abstrak->judul_abstrak,
            'penulis' => $user->nama_lengkap,
            'tanggalSurat' => $tanggal->translatedFormat('j F Y'),
            'logoStarnas' => $gambar('logo-starnas.png'),
            'logoAsasi' => $gambar('logo-asasi.png'),
            'ttdKetua' => $gambar('ttd-ketua.png'),
        ])->setPaper('a4');

        return $pdf->download('LoA_' . $idNaskah . '.pdf');
    }

    public function deleteAbstrak(Abstrak $abstrak)
    {
        abort_if($abstrak->user_id !== Auth::id(), 403);

        if ($abstrak->status_abstrak === 'diterima') {
            return redirect()->route('peserta.abstrak.upload')->with('error', 'Abstrak yang sudah diterima tidak dapat dihapus.');
        }

        if ($abstrak->file_abstrak_path && Storage::disk('public')->exists($abstrak->file_abstrak_path)) {
            Storage::disk('public')->delete($abstrak->file_abstrak_path);
        }

        $abstrak->delete();

        return redirect()->route('peserta.abstrak.upload')->with('success', 'Abstrak berhasil dihapus.');
    }

    public function downloadInvoice(Pembayaran $pembayaran)
    {
        $user = User::find(Auth::id());
        abort_if($pembayaran->user_id !== $user->id, 403);

        $nomorInvoice = 'INV-STARNAS-' . now()->year . '-' . str_pad($pembayaran->id, 5, '0', STR_PAD_LEFT);

        $logoPath = null;
        $possiblePaths = [
            storage_path('app/public/starnas.png'),
            public_path('storage/starnas.png'),
            base_path('public_html/storage/starnas.png'),
        ];
        foreach ($possiblePaths as $path) {
            if (file_exists($path)) { $logoPath = $path; break; }
        }
        $logoBase64 = $logoPath ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : null;

        $pdf = Pdf::loadView('peserta.invoice_pdf', [
            'pembayaran' => $pembayaran,
            'user' => $user,
            'nomorInvoice' => $nomorInvoice,
            'logoBase64' => $logoBase64,
        ])->setPaper('a4');

        return $pdf->download('Invoice_STARNAS_' . $nomorInvoice . '.pdf');
    }}
