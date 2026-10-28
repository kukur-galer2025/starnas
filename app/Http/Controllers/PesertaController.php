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

class PesertaController extends Controller
{
    public function beranda()
    {
        $user = Auth::user();
        $pembayaran = Pembayaran::where('user_id', $user->id)->latest()->first();

        return view('peserta.beranda', compact('pembayaran'));
    }

    public function caraPembayaran()
    {
        $user = Auth::user();
        $pembayaran = Pembayaran::where('user_id', $user->id)->latest()->first();

        return view('peserta.pembayaran_cara', compact('pembayaran'));
    }

    public function uploadBukti()
    {
        $user = Auth::user();
        $pembayaran = Pembayaran::where('user_id', $user->id)->latest()->first();

        return view('peserta.pembayaran_upload', compact('pembayaran'));
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

            return redirect()->route('peserta.riwayat')->with('success', 'Bukti pembayaran berhasil diunggah.');
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
        $abstrak = Abstrak::where('user_id', $user->id)->latest()->first();

        return view('peserta.riwayat', compact('riwayat_pembayaran', 'abstrak'));
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
            'pekerjaan' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
            'nomor_handphone' => 'nullable|string|max:15',
            'provinsi' => 'nullable|string|max:255',
            'institusi' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['nama_lengkap', 'pekerjaan', 'jenis_kelamin', 'nomor_handphone', 'provinsi', 'institusi']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

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
            'tempat_acara' => 'Grand Hotel De Djokja, Yogyakarta',
            'tema' => 'AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi',
        ];

        return view('peserta.sertifikat_preview', $sertifikatData);
    }

    public function uploadAbstrak()
    {
        $user = User::find(Auth::id())->load('abstrak');
        $pembayaran = Pembayaran::where('user_id', $user->id)->latest()->first();
        $abstrak = $user->abstrak ?: new Abstrak(['user_id' => $user->id]);

        return view('peserta.upload_abstrak', compact('user', 'pembayaran', 'abstrak'));
    }

    public function storeAbstrak(Request $request)
    {
        try {
            $request->validate([
                'judul_abstrak' => 'required|string|max:255',
                'abstrak_file' => 'required|file|mimes:doc,docx,pdf|max:10240'
            ]);

            $user = Auth::user();
            $abstrak = Abstrak::firstOrNew(['user_id' => $user->id]);

            if ($abstrak->file_abstrak_path && Storage::disk('public')->exists($abstrak->file_abstrak_path)) {
                Storage::disk('public')->delete($abstrak->file_abstrak_path);
            }

            $file = $request->file('abstrak_file');
            $filePath = $file->storeAs('abstrak', 'abstrak_' . time() . '_' . $user->id . '.' . $file->getClientOriginalExtension(), 'public');

            $abstrak->fill([
                'judul_abstrak' => $request->judul_abstrak,
                'file_abstrak_path' => $filePath,
                'file_abstrak_original_name' => $file->getClientOriginalName(),
                'status_abstrak' => 'pending',
                'catatan_reviewer_abstrak' => null,
            ]);
            $abstrak->save();

            return redirect()->route('peserta.riwayat')->with('success', 'Abstrak berhasil diupload.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function downloadAbstrak()
    {
        $user = User::find(Auth::id())->load('abstrak');
        $abstrak = $user->abstrak;

        if (!$abstrak || !$abstrak->file_abstrak_path) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $filePath = storage_path('app/public/' . $abstrak->file_abstrak_path);

        if (!file_exists($filePath)) {
            // Fallback check
            $filePathPublic = public_path('storage/' . $abstrak->file_abstrak_path);
            if (file_exists($filePathPublic)) {
                 return response()->download($filePathPublic, $abstrak->file_abstrak_original_name);
            }
            return redirect()->back()->with('error', 'File fisik tidak ditemukan di server.');
        }

        return response()->download($filePath, $abstrak->file_abstrak_original_name);
    }

    public function deleteAbstrak()
    {
        $user = User::find(Auth::id())->load('abstrak');
        $abstrak = $user->abstrak;

        if ($abstrak) {
            if ($abstrak->file_abstrak_path && Storage::disk('public')->exists($abstrak->file_abstrak_path)) {
                Storage::disk('public')->delete($abstrak->file_abstrak_path);
            }
            $abstrak->delete();
        }

        return redirect()->route('peserta.riwayat')->with('success', 'Abstrak berhasil dihapus.');
    }
}