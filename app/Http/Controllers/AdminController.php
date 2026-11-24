<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Abstrak; // <-- Model Abstrak baru di-import
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Response;
use App\Support\NotifPeserta;
use App\Models\EmailLog;
use App\Models\Pengumuman;
use App\Models\SertifikatKhusus;
use App\Support\EksporExcel;
use App\Support\Verifikasi;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Penanda perubahan data abstrak & pembayaran, dipoll browser admin
     * agar daftar/dashboard otomatis ikut ter-update.
     */
    public function statusSinkron()
    {
        // Panel admin yang terbuka sekaligus menggerakkan antrean email (pengumuman massal).
        NotifPeserta::prosesAntreanNanti();

        $abstrak = Abstrak::selectRaw('count(*) as total, max(updated_at) as terakhir')->first();
        $pembayaran = Pembayaran::selectRaw('count(*) as total, max(updated_at) as terakhir')->first();

        return response()->json([
            'abstrak' => $abstrak->total . '|' . $abstrak->terakhir,
            'pembayaran' => $pembayaran->total . '|' . $pembayaran->terakhir,
            'user' => User::count(),
            'email' => EmailLog::count() . '|' . EmailLog::max('updated_at'),
        ])->header('Cache-Control', 'no-store, max-age=0');
    }

    public function dashboard()
    {
        $stat = [
            'peserta' => User::where('role', 'peserta')->count(),
            'peserta_baru' => User::where('role', 'peserta')->where('created_at', '>=', now()->subDay())->count(),
            'abstrak_total' => Abstrak::count(),
            'abstrak_pending' => Abstrak::where('status_abstrak', 'pending')->count(),
            'abstrak_diterima' => Abstrak::where('status_abstrak', 'diterima')->count(),
            'abstrak_ditolak' => Abstrak::where('status_abstrak', 'ditolak')->count(),
            'bayar_pending' => Pembayaran::where('status', 'pending')->count(),
            'bayar_verified' => Pembayaran::where('status', 'verified')->count(),
            'pemasukan' => Pembayaran::where('status', 'verified')->sum('nominal'),
            'email_terkirim' => EmailLog::where('status', 'terkirim')->count(),
            'email_gagal' => EmailLog::where('status', 'gagal')->count(),
            'email_antri' => EmailLog::where('status', 'antri')->count(),
        ];

        $abstrakMenunggu = Abstrak::with('user')->where('status_abstrak', 'pending')->oldest()->take(5)->get();
        $bayarMenunggu = Pembayaran::with('user')->where('status', 'pending')->oldest()->take(5)->get();
        $emailTerbaru = EmailLog::latest()->take(6)->get();

        return view('admin.dashboard', compact('stat', 'abstrakMenunggu', 'bayarMenunggu', 'emailTerbaru'));
    }

    /**
     * Riwayat & status pengiriman email notifikasi.
     */
    public function emailLogs(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');

        $logs = EmailLog::with('user')
            ->when(in_array($status, ['antri', 'terkirim', 'gagal']), fn ($q) => $q->where('status', $status))
            ->when($search, fn ($q) => $q->where(fn ($w) => $w->where('email', 'like', "%{$search}%")->orWhere('subjek', 'like', "%{$search}%")))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $ringkas = [
            'semua' => EmailLog::count(),
            'terkirim' => EmailLog::where('status', 'terkirim')->count(),
            'gagal' => EmailLog::where('status', 'gagal')->count(),
            'antri' => EmailLog::where('status', 'antri')->count(),
        ];

        $kuotaHabisSampai = EmailLog::kuotaHabisSampai();

        return view('admin.emails.index', compact('logs', 'ringkas', 'status', 'search', 'kuotaHabisSampai'));
    }

    /** Pesan peringatan bila pengiriman sedang ditunda karena kuota email habis. */
    private function peringatanKuotaEmail(): ?string
    {
        $sampai = EmailLog::kuotaHabisSampai();

        return $sampai
            ? 'Kuota harian akun email pengirim sedang habis. Pengiriman ditunda, coba kirim ulang setelah pukul ' . $sampai->timezone(config('app.timezone'))->format('H:i') . '.'
            : null;
    }

    public function resendEmail(EmailLog $emailLog)
    {
        if ($emailLog->status === 'terkirim') {
            return back()->with('warning', 'Email ini sudah terkirim.');
        }

        if ($pesan = $this->peringatanKuotaEmail()) {
            return back()->with('warning', $pesan);
        }

        $emailLog->update(['status' => 'antri', 'percobaan' => 0, 'error' => null]);
        NotifPeserta::jadwalkan($emailLog);

        return back()->with('success', 'Email ke ' . $emailLog->email . ' sedang dikirim ulang.');
    }

    public function resendFailedEmails()
    {
        if ($pesan = $this->peringatanKuotaEmail()) {
            return back()->with('warning', $pesan);
        }

        $logs = EmailLog::where('status', 'gagal')
            ->orWhere(fn ($q) => $q->where('status', 'antri')->where('updated_at', '<', now()->subMinutes(5)))
            ->take(500)
            ->get();

        // Masukkan ke antrean; dikirim bertahap (10 per putaran) selama panel admin terbuka,
        // agar tidak menabrak batas kirim penyedia email sekaligus.
        EmailLog::whereIn('id', $logs->pluck('id'))->update(['status' => 'antri', 'percobaan' => 0, 'error' => null, 'updated_at' => now()]);
        NotifPeserta::prosesAntreanNanti($logs->pluck('id')->take(NotifPeserta::BATCH_ANTREAN)->all());

        return back()->with('success', $logs->count() . ' email masuk antrean kirim ulang. Email terkirim bertahap; biarkan halaman admin terbuka sampai selesai.');
    }

    public function manageUsers(Request $request)
    {
        $search = $request->input('search');
        $usersQuery = User::orderBy('created_at', 'desc');

        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nomor_handphone', 'like', '%' . $search . '%');
            });
        }

        $users = $usersQuery->paginate(15)->withQueryString(); 

        return view('admin.users.index', compact('users', 'search'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            
            'nomor_handphone' => 'nullable|string|max:15',
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'pekerjaan' => 'nullable|string|max:255',
            'institusi' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            
            'role' => ['required', Rule::in(['admin', 'peserta'])],
            'password' => 'nullable|string|min:8',
        ]);

        $data = $request->except(['password', '_token', '_method']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }
    
    public function managePayments(Request $request)
    {
        $search = $request->input('search');
        
        $paymentsQuery = Pembayaran::with(['user', 'abstrak:id,judul_abstrak'])->orderBy('created_at', 'desc');

        if ($search) {
            $paymentsQuery->whereHas('user', function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%');
            });
        }

        $payments = $paymentsQuery->paginate(15)->withQueryString();
        
        return view('admin.payments.index', compact('payments', 'search'));
    }

    public function showPayment(Pembayaran $pembayaran)
    {
        $pembayaran->load(['user', 'abstrak']);
        $emailLogs = EmailLog::where('user_id', $pembayaran->user_id)->latest()->take(8)->get();
        $abstraksPeserta = Abstrak::where('user_id', $pembayaran->user_id)->latest()->get();

        // Cocokkan kategori yang dibayar dengan status abstrak peserta.
        $adaDiterima = $abstraksPeserta->contains('status_abstrak', 'diterima');
        $peringatanKategori = match (true) {
            $pembayaran->kategori_pembayaran === 'non-presenter' && $adaDiterima
                => 'Peserta ini punya abstrak DITERIMA tetapi membayar kategori Non Presenter (Rp100.000). Bila tetap akan presentasi, minta peserta membayar kategori pemakalah. Sertifikat peserta ini akan tertulis "Peserta Seminar".',
            $pembayaran->kategori_pembayaran !== 'non-presenter' && $pembayaran->abstrak && $pembayaran->abstrak->status_abstrak !== 'diterima'
                => 'Abstrak yang dibayar ("' . $pembayaran->abstrak->judul_abstrak . '") belum berstatus DITERIMA. Pastikan abstraknya sudah direview sebelum memverifikasi.',
            $pembayaran->kategori_pembayaran !== 'non-presenter' && !$adaDiterima
                => 'Peserta ini membayar kategori PEMAKALAH tetapi belum punya abstrak yang diterima. Pastikan abstraknya sudah direview sebelum memverifikasi.',
            default => null,
        };

        return view('admin.payments.show', compact('pembayaran', 'emailLogs', 'abstraksPeserta', 'peringatanKategori'));
    }

    public function verifyPayment(Request $request, Pembayaran $pembayaran)
    {
        try {
            $request->validate([
                'catatan_admin' => 'nullable|string|max:500', 
            ], [
                'catatan_admin.max' => 'Catatan admin maksimal 500 karakter.',
            ]);

        } catch (ValidationException $e) {
            return redirect()->back()
                            ->withErrors($e->errors())
                            ->withInput()
                            ->with('show_verify_form', true);
        }

        if ($pembayaran->status === 'verified') {
            return redirect()->back()->with('error', 'Pembayaran sudah diverifikasi sebelumnya.');
        }

        $pembayaran->update([
            'status' => 'verified',
            'catatan_admin' => $request->input('catatan_admin', 'Pembayaran telah dikonfirmasi.')
        ]);
        
        NotifPeserta::kirim($pembayaran->user, 'Pembayaran Terverifikasi', 'Pembayaran Anda telah diverifikasi',
            ['Terima kasih, pembayaran pendaftaran Anda' . ($pembayaran->abstrak ? ' untuk abstrak "' . $pembayaran->abstrak->judul_abstrak . '"' : '') . ' telah kami terima dan diverifikasi.', 'Kwitansi dapat diunduh melalui halaman Riwayat Status di dashboard peserta.'],
            $request->input('catatan_admin'), 'Buka Riwayat Status', route('peserta.riwayat'));

        return redirect()->route('admin.payments.show', $pembayaran->id)->with('success', 'Pembayaran dari ' . $pembayaran->user->nama_lengkap . ' berhasil diverifikasi.');
    }

    public function rejectPayment(Request $request, Pembayaran $pembayaran)
    {
        try {
            $request->validate([
                'catatan_admin' => 'required|string|min:10',
            ], [
                'catatan_admin.required' => 'Catatan penolakan wajib diisi agar peserta tahu alasannya.',
                'catatan_admin.min' => 'Catatan penolakan minimal 10 karakter.'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()
                            ->withErrors($e->errors())
                            ->withInput()
                            ->with('show_reject_form', true);
        }
        
        $pembayaran->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin
        ]);
        
        NotifPeserta::kirim($pembayaran->user, 'Pembayaran Ditolak', 'Bukti pembayaran Anda belum dapat diverifikasi',
            ['Mohon maaf, bukti pembayaran Anda' . ($pembayaran->abstrak ? ' untuk abstrak "' . $pembayaran->abstrak->judul_abstrak . '"' : '') . ' ditolak. Silakan unggah ulang bukti pembayaran yang sesuai.'],
            $request->catatan_admin, 'Upload Ulang Bukti', route('peserta.pembayaran.upload', array_filter(['abstrak' => $pembayaran->abstrak_id])));

        return redirect()->route('admin.payments.show', $pembayaran->id)->with('success', 'Pembayaran dari ' . $pembayaran->user->nama_lengkap . ' berhasil ditolak.');
    }

    /**
     * ROUTE BARU untuk melayani file bukti pembayaran secara terproteksi.
     */
    public function viewBuktiPembayaran(Pembayaran $pembayaran)
    {
        if (!$pembayaran->bukti_path) {
            abort(404, 'Bukti pembayaran tidak ditemukan.');
        }

        $filePath = $pembayaran->bukti_path;

        if (Storage::disk('public')->exists($filePath)) {
            // Menggunakan response() untuk melayani file
            return Storage::disk('public')->response($filePath, basename($filePath), [
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
            ]);
        }

        abort(404, 'File bukti tidak ditemukan di server.');
    }

    // ==========================================================
    // == METHOD: UNDUH KWITANSI SATUAN (Menggunakan Base64) ==
    // ==========================================================
    
    public function unduhKwitansi(Pembayaran $pembayaran)
    {
        if ($pembayaran->status !== 'verified') {
            return redirect()->back()->with('error', 'Kwitansi tidak dapat diunduh karena status pembayaran belum LUNAS (verified).');
        }

        $base64Logo = null;
        try {
            $logoPath = public_path('storage/logo-starnas-asasi.jpeg'); 

            if (file_exists($logoPath)) {
                $logoType = pathinfo($logoPath, PATHINFO_EXTENSION);
                $logoData = file_get_contents($logoPath);
                $base64Logo = 'data:image/' . $logoType . ';base64,' . base64_encode($logoData);
            } else {
                 Log::warning('File logo tidak ditemukan di: ' . $logoPath);
            }
        } catch (\Exception $e) {
            Log::error('Gagal memuat logo untuk PDF kwitansi: ' . $e->getMessage());
        }

        $viewName = 'admin.payments.kwitansi'; 

        $pdf = Pdf::loadView($viewName, [
            'pembayaran' => $pembayaran,
            'base64' => $base64Logo 
        ]);

        $safeNama = preg_replace('/[^A-Za-z0-9_]/', '', $pembayaran->user->nama_lengkap);
        $filename = 'Kwitansi_PMT' . $pembayaran->id . '_' . $safeNama . '.pdf';

        return $pdf->download($filename);
    }
    
    // ==========================================================
    // == METHOD BARU: MANAJEMEN ABSTRAK (MENGGUNAKAN TABEL ABSTRAK) ==
    // ==========================================================

    /**
     * Menampilkan daftar abstrak yang perlu diverifikasi
     */
    public function manageAbstracts(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');
        
        // Query langsung ke tabel abstrak
        $abstractsQuery = Abstrak::with('user')->orderBy('created_at', 'desc');

        if ($status !== 'all') {
            $abstractsQuery->where('status_abstrak', $status);
        }

        if ($search) {
            $abstractsQuery->where(function ($query) use ($search) {
                $query->where('judul_abstrak', 'like', '%' . $search . '%')
                      ->orWhereHas('user', function ($q) use ($search) {
                          $q->where('nama_lengkap', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                      });
            });
        }
        
        $abstracts = $abstractsQuery->paginate(15)->withQueryString();
        
        $pendingCount = Abstrak::where('status_abstrak', 'pending')->count();
        $acceptedCount = Abstrak::where('status_abstrak', 'diterima')->count();
        $rejectedCount = Abstrak::where('status_abstrak', 'ditolak')->count();

        return view('admin.abstracts.index', compact('abstracts', 'search', 'status', 'pendingCount', 'acceptedCount', 'rejectedCount'));
    }

    /**
     * Menampilkan detail abstrak
     */
    public function showAbstract(Abstrak $abstrak) 
    {
        if (!$abstrak->file_abstrak_path) {
            return redirect()->route('admin.abstracts.index')->with('error', 'Record abstrak tidak lengkap.');
        }
        
        // Memuat relasi user
        $abstrak->load('user');

        $emailLogs = EmailLog::where('user_id', $abstrak->user_id)->latest()->take(8)->get();

        return view('admin.abstracts.show', compact('abstrak', 'emailLogs'));
    }

    /**
     * Verifikasi abstrak (diterima)
     */
    public function verifyAbstract(Request $request, Abstrak $abstrak) 
    {
        try {
            $request->validate([
                'catatan_reviewer_abstrak' => 'nullable|string|max:1000',
            ], [
                'catatan_reviewer_abstrak.max' => 'Catatan reviewer maksimal 1000 karakter.',
            ]);

        } catch (ValidationException $e) {
            return redirect()->back()
                             ->withErrors($e->errors())
                             ->withInput()
                             ->with('show_verify_form', true);
        }

        if ($abstrak->status_abstrak === 'diterima') {
            return redirect()->back()->with('error', 'Abstrak sudah diverifikasi sebelumnya.');
        }

        $abstrak->update([
            'status_abstrak' => 'diterima',
            'catatan_reviewer_abstrak' => $request->input('catatan_reviewer_abstrak', 'Abstrak telah diterima dan memenuhi syarat.')
        ]);
        
        NotifPeserta::kirim($abstrak->user, 'Abstrak Diterima', 'Selamat, abstrak Anda diterima',
            ['Abstrak Anda berjudul "' . $abstrak->judul_abstrak . '" telah diterima.', 'Anda sekarang dapat melanjutkan ke tahap pembayaran untuk abstrak ini. Setiap abstrak yang dipresentasikan dibayar terpisah.'],
            $abstrak->catatan_reviewer_abstrak, 'Lanjut ke Pembayaran', route('peserta.pembayaran.upload', ['abstrak' => $abstrak->id]));

        return redirect()->route('admin.abstracts.show', $abstrak->id)->with('success', 'Abstrak dari ' . $abstrak->user->nama_lengkap . ' berhasil diverifikasi.');
    }

    /**
     * Tolak abstrak
     */
    public function rejectAbstract(Request $request, Abstrak $abstrak) 
    {
        try {
            $request->validate([
                'catatan_reviewer_abstrak' => 'required|string|min:10|max:1000',
            ], [
                'catatan_reviewer_abstrak.required' => 'Catatan penolakan wajib diisi agar peserta tahu alasannya.',
                'catatan_reviewer_abstrak.min' => 'Catatan penolakan minimal 10 karakter.',
                'catatan_reviewer_abstrak.max' => 'Catatan penolakan maksimal 1000 karakter.'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()
                             ->withErrors($e->errors())
                             ->withInput()
                             ->with('show_reject_form', true);
        }
        
        $abstrak->update([
            'status_abstrak' => 'ditolak',
            'catatan_reviewer_abstrak' => $request->catatan_reviewer_abstrak
        ]);
        
        NotifPeserta::kirim($abstrak->user, 'Abstrak Perlu Perbaikan', 'Abstrak Anda belum dapat diterima',
            ['Abstrak Anda berjudul "' . $abstrak->judul_abstrak . '" belum dapat diterima. Silakan perbaiki dan unggah ulang.'],
            $request->catatan_reviewer_abstrak, 'Upload Ulang Abstrak', route('peserta.abstrak.upload'));

        return redirect()->route('admin.abstracts.show', $abstrak->id)->with('success', 'Abstrak dari ' . $abstrak->user->nama_lengkap . ' berhasil ditolak.');
    }

    /**
     * Download file abstrak
     */
    public function downloadAbstract(Abstrak $abstrak) 
    {
        if (!$abstrak->file_abstrak_path || !Storage::disk('public')->exists($abstrak->file_abstrak_path)) {
            return redirect()->back()->with('error', 'File abstrak tidak ditemukan.');
        }

        return Storage::disk('public')->download($abstrak->file_abstrak_path, $abstrak->file_abstrak_original_name);
    }

    // ==========================================================
    // == METHOD: EKSPOR LAPORAN PDF (Menggunakan URL Publik) ==
    // ==========================================================

    /**
     * Kolom yang dapat dipilih admin untuk laporan: key => [label, lebar PDF (%)].
     */
    private const KOLOM_LAPORAN = [
        'nama' => ['Nama Peserta', 15],
        'email' => ['Email', 18],
        'hp' => ['No. HP', 10],
        'institusi' => ['Institusi', 15],
        'kategori' => ['Kategori', 12],
        'nominal' => ['Nominal', 9],
        'status' => ['Status', 9],
        'tgl_upload' => ['Tgl Upload', 9],
        'tgl_verifikasi' => ['Tgl Verifikasi', 9],
        'catatan' => ['Catatan Admin', 16],
    ];

    private const KOLOM_DEFAULT = ['nama', 'email', 'hp', 'kategori', 'nominal', 'status', 'tgl_verifikasi'];

    /**
     * Query laporan pembayaran berdasarkan filter (dipakai halaman, PDF, dan CSV).
     */
    private function queryLaporan(Request $request)
    {
        $status = array_values(array_intersect((array) $request->input('status', []), array_keys(Pembayaran::STATUS)));
        $kategori = array_values(array_intersect((array) $request->input('kategori', []), array_keys(Pembayaran::KATEGORI)));
        $ids = array_filter(array_map('intval', (array) $request->input('ids', [])));
        $search = trim((string) $request->input('search'));
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        $query = Pembayaran::with('user')
            ->when($ids, fn ($q) => $q->whereIn('id', $ids))
            ->when($status, fn ($q) => $q->whereIn('status', $status))
            ->when($kategori, fn ($q) => $q->whereIn('kategori_pembayaran', $kategori))
            ->when($dari, fn ($q) => $q->whereDate('created_at', '>=', $dari))
            ->when($sampai, fn ($q) => $q->whereDate('created_at', '<=', $sampai))
            ->when($search !== '', function ($q) use ($search) {
                $q->whereHas('user', fn ($u) => $u->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nomor_handphone', 'like', "%{$search}%")
                    ->orWhere('institusi', 'like', "%{$search}%"));
            });

        match ($request->input('urut')) {
            'terbaru' => $query->orderByDesc('created_at'),
            'nominal' => $query->orderByDesc('nominal'),
            'nama' => $query->orderBy(
                \App\Models\User::select('nama_lengkap')->whereColumn('users.id', 'pembayaran.user_id')->limit(1)
            ),
            default => $query->orderBy('created_at'),
        };

        return $query;
    }

    private function kolomTerpilih(Request $request): array
    {
        $dipilih = array_values(array_intersect(array_keys(self::KOLOM_LAPORAN), (array) $request->input('kolom', [])));

        return $dipilih ?: self::KOLOM_DEFAULT;
    }

    private function nilaiKolom(Pembayaran $p, string $kolom): string
    {
        return match ($kolom) {
            'nama' => $p->user->nama_lengkap ?? '-',
            'email' => $p->user->email ?? '-',
            'hp' => $p->user->nomor_handphone ?: '-',
            'institusi' => $p->user->institusi ?: '-',
            'kategori' => $p->labelKategori(),
            'nominal' => (string) (int) $p->nominal,
            'status' => $p->labelStatus(),
            'tgl_upload' => $p->created_at->format('d/m/Y'),
            'tgl_verifikasi' => $p->status === 'verified' ? $p->updated_at->format('d/m/Y') : '-',
            'catatan' => $p->catatan_admin ?: '-',
            default => '',
        };
    }

    private function ringkasanFilter(Request $request): array
    {
        $ringkas = [];
        if ($s = (array) $request->input('status')) {
            $ringkas[] = 'Status: ' . implode(', ', array_map(fn ($x) => Pembayaran::STATUS[$x] ?? $x, $s));
        }
        if ($k = (array) $request->input('kategori')) {
            $ringkas[] = 'Kategori: ' . implode(', ', array_map(fn ($x) => Pembayaran::KATEGORI[$x] ?? $x, $k));
        }
        if ($request->filled('dari') || $request->filled('sampai')) {
            $ringkas[] = 'Tanggal upload: ' . ($request->input('dari') ?: '...') . ' s/d ' . ($request->input('sampai') ?: '...');
        }
        if ($request->filled('search')) {
            $ringkas[] = 'Pencarian: "' . $request->input('search') . '"';
        }
        if (array_filter((array) $request->input('ids'))) {
            $ringkas[] = 'Hanya baris yang dipilih (' . count(array_filter((array) $request->input('ids'))) . ')';
        }

        return $ringkas;
    }

    public function showPaymentsReport(Request $request)
    {
        $payments = $this->queryLaporan($request)->get();
        $kolomList = self::KOLOM_LAPORAN;
        $kolomDipilih = $this->kolomTerpilih($request);

        $totalSemua = Pembayaran::count();
        $totalVerified = $payments->where('status', 'verified')->sum('nominal');

        return view('admin.reports.index', compact('payments', 'kolomList', 'kolomDipilih', 'totalSemua', 'totalVerified'));
    }

    public function exportPaymentsPdf(Request $request)
    {
        $payments = $this->queryLaporan($request)->get();
        $kolomDipilih = $this->kolomTerpilih($request);
        $kolomList = self::KOLOM_LAPORAN;
        $filter = $this->ringkasanFilter($request);
        $nilai = fn (Pembayaran $p, string $k) => $this->nilaiKolom($p, $k);

        $logoPath = public_path('storage/logo-starnas-asasi.jpeg');
        $logoUrl = is_file($logoPath)
            ? 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath))
            : '';

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => false,
        ])->loadView('admin.reports.payments_pdf', compact('payments', 'logoUrl', 'kolomDipilih', 'kolomList', 'filter', 'nilai'));

        $nama = 'Laporan_Pembayaran_STARNAS_' . now()->format('Ymd_His') . '.pdf';

        // ?tampil=1 -> buka di tab baru (siap dicetak), selain itu unduh.
        return $request->boolean('tampil') ? $pdf->stream($nama) : $pdf->download($nama);
    }

    // ==========================================================
    // == PENGUMUMAN / BROADCAST KE PESERTA ==
    // ==========================================================

    public function pengumumanIndex()
    {
        $pengumumans = Pengumuman::with('admin')->latest()->paginate(10);
        $jumlahTarget = collect(Pengumuman::TARGET)->map(fn ($label, $key) => Pengumuman::queryPenerima($key)->count());

        return view('admin.pengumuman.index', compact('pengumumans', 'jumlahTarget'));
    }

    public function pengumumanStore(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'isi' => 'required|string|max:5000',
            'target' => ['required', Rule::in(array_keys(Pengumuman::TARGET))],
            'tautan' => 'nullable|url|max:500',
            'teks_tautan' => 'nullable|string|max:60',
            'kirim_email' => 'nullable|boolean',
        ], [
            'tautan.url' => 'Tautan harus berupa alamat lengkap, mis. https://zoom.us/j/123...',
        ]);

        $penerima = Pengumuman::queryPenerima($data['target'])->get(['id', 'nama_lengkap', 'email']);
        if ($penerima->isEmpty()) {
            return back()->withInput()->with('error', 'Tidak ada peserta pada kelompok "' . Pengumuman::TARGET[$data['target']] . '".');
        }

        $pengumuman = Pengumuman::create([
            'admin_id' => auth()->id(),
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'target' => $data['target'],
            'tautan' => $data['tautan'] ?? null,
            'teks_tautan' => ($data['tautan'] ?? null) ? (($data['teks_tautan'] ?? null) ?: 'Buka Tautan') : null,
            'kirim_email' => $request->boolean('kirim_email'),
            'jumlah_penerima' => $penerima->count(),
        ]);

        $urlHalaman = route('peserta.pengumuman');
        $paragraf = array_values(array_filter(array_map('trim', preg_split('/\R/', $pengumuman->isi))));
        $idEmail = [];

        foreach ($penerima as $user) {
            NotifPeserta::buatNotifikasi($user, $pengumuman->judul, Str::limit($pengumuman->isi, 140), $urlHalaman, $pengumuman->id);

            if ($pengumuman->kirim_email) {
                $log = NotifPeserta::catatEmail($user, 'Pengumuman: ' . $pengumuman->judul, $pengumuman->judul, $paragraf,
                    null, $pengumuman->teks_tautan ?? 'Lihat di Dashboard', $pengumuman->tautan ?? $urlHalaman);
                if ($log) {
                    $idEmail[] = $log->id;
                }
            }
        }

        if ($idEmail) {
            NotifPeserta::prosesAntreanNanti(array_slice($idEmail, 0, NotifPeserta::BATCH_ANTREAN));
        }

        $pesan = 'Pengumuman terkirim ke ' . $penerima->count() . ' peserta (notifikasi dashboard).';
        if ($idEmail) {
            $pesan .= ' ' . count($idEmail) . ' email dikirim bertahap; pantau di menu Status Email dan biarkan halaman admin terbuka sampai selesai.';
        }

        return redirect()->route('admin.pengumuman.index')->with('success', $pesan);
    }

    public function pengumumanDestroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete(); // notifikasi lonceng ikut terhapus (cascade)

        return back()->with('success', 'Pengumuman "' . $pengumuman->judul . '" dihapus dari dashboard peserta.');
    }

    // ==========================================================
    // == EKSPOR EXCEL ==
    // ==========================================================

    public function exportPesertaExcel()
    {
        $users = User::where('role', 'peserta')
            ->with(['pembayarans' => fn ($q) => $q->latest()])
            ->withCount(['abstraks', 'abstraks as abstrak_diterima_count' => fn ($q) => $q->where('status_abstrak', 'diterima')])
            ->orderBy('nama_lengkap')
            ->get();

        $baris = $users->values()->map(function (User $u, $i) {
            // Peserta bisa punya beberapa pembayaran (satu per abstrak): ringkas semuanya
            $bayars = $u->pembayarans;
            $kategori = $bayars->map->labelKategori()->unique()->implode(', ');
            $status = $bayars->isEmpty() ? 'Belum bayar'
                : $bayars->groupBy('status')->map(fn ($g, $s) => $g->count() . ' ' . (Pembayaran::STATUS[$s] ?? $s))->implode(', ');
            return [
                $i + 1, $u->nama_lengkap, $u->email, $u->nomor_handphone ?: '-', $u->jenis_kelamin ?: '-',
                $u->pekerjaan ?: '-', $u->institusi ?: '-', $u->provinsi ?: '-',
                $kategori ?: '-', $status,
                (int) $bayars->where('status', 'verified')->sum('nominal'), $u->abstraks_count, $u->abstrak_diterima_count,
                $u->google_id ? 'Google' : 'Email', $u->created_at?->format('d/m/Y H:i'),
            ];
        });

        return EksporExcel::unduh('Data_Peserta_STARNAS_' . now()->format('Ymd_His'), 'Peserta',
            ['No', 'Nama Lengkap', 'Email', 'No. HP', 'Jenis Kelamin', 'Pekerjaan', 'Institusi', 'Provinsi',
             'Kategori Bayar', 'Status Bayar', 'Nominal Terverifikasi', 'Jumlah Abstrak', 'Abstrak Diterima', 'Daftar Via', 'Tanggal Daftar'],
            $baris);
    }

    public function exportAbstrakExcel(Request $request)
    {
        $status = $request->input('status', 'all');
        $search = $request->input('search');

        $abstraks = Abstrak::with(['user', 'pembayaranTerakhir'])
            ->when($status !== 'all', fn ($q) => $q->where('status_abstrak', $status))
            ->when($search, fn ($q) => $q->where(fn ($w) => $w->where('judul_abstrak', 'like', '%' . $search . '%')
                ->orWhereHas('user', fn ($u) => $u->where('nama_lengkap', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%'))))
            ->orderBy('created_at')
            ->get();

        $labelStatus = ['pending' => 'Menunggu Review', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak'];

        $baris = $abstraks->values()->map(function (Abstrak $a, $i) use ($labelStatus) {
            $bayar = $a->pembayaranTerakhir;
            return [
                $i + 1, Verifikasi::idNaskah($a->id), $a->judul_abstrak, $a->penulis ?: ($a->user->nama_lengkap ?? '-'),
                $a->user->nama_lengkap ?? '-', $a->user->email ?? '-', $a->user->nomor_handphone ?? '-', $a->user->institusi ?? '-',
                $labelStatus[$a->status_abstrak] ?? $a->status_abstrak, $a->catatan_reviewer_abstrak ?: '-',
                $a->created_at?->format('d/m/Y H:i'),
                $bayar ? $bayar->labelKategori() : '-', $bayar ? $bayar->labelStatus() : 'Belum bayar',
            ];
        });

        return EksporExcel::unduh('Data_Abstrak_STARNAS_' . now()->format('Ymd_His'), 'Abstrak',
            ['No', 'ID Naskah', 'Judul', 'Penulis', 'Pengunggah', 'Email', 'No. HP', 'Institusi',
             'Status', 'Catatan Reviewer', 'Tanggal Upload', 'Kategori Bayar', 'Status Bayar'],
            $baris);
    }

    public function exportPaymentsExcel(Request $request)
    {
        $payments = $this->queryLaporan($request)->get();
        $kolom = $this->kolomTerpilih($request);

        $baris = $payments->values()->map(function (Pembayaran $p, $i) use ($kolom) {
            return array_merge([$i + 1], array_map(
                fn ($k) => $k === 'nominal' ? (int) $p->nominal : $this->nilaiKolom($p, $k), $kolom));
        });

        return EksporExcel::unduh('Laporan_Pembayaran_STARNAS_' . now()->format('Ymd_His'), 'Pembayaran',
            array_merge(['No'], array_map(fn ($k) => self::KOLOM_LAPORAN[$k][0], $kolom)),
            $baris);
    }

    // ==========================================================
    // == SERTIFIKAT KHUSUS (PANITIA / PEMBICARA / DLL) ==
    // ==========================================================

    public function sertifikatKhususIndex(Request $request)
    {
        $peran = $request->input('peran');
        $search = $request->input('search');

        $sertifikats = SertifikatKhusus::query()
            ->when(in_array($peran, SertifikatKhusus::PERAN, true), fn ($q) => $q->where('peran', $peran))
            ->when($search, fn ($q) => $q->where(fn ($w) => $w->where('nama', 'like', '%' . $search . '%')->orWhere('institusi', 'like', '%' . $search . '%')))
            ->orderBy('peran')->orderBy('nama')
            ->paginate(25)->withQueryString();

        $jumlahPeran = SertifikatKhusus::selectRaw('peran, count(*) as jumlah')->groupBy('peran')->pluck('jumlah', 'peran');

        return view('admin.sertifikat.index', compact('sertifikats', 'jumlahPeran', 'peran', 'search'));
    }

    /**
     * Simpan satu atau banyak sertifikat sekaligus.
     * Kolom "daftar": satu orang per baris, format "Nama" atau "Nama | Institusi".
     */
    public function sertifikatKhususStore(Request $request)
    {
        $data = $request->validate([
            'peran' => ['required', Rule::in(SertifikatKhusus::PERAN)],
            'daftar' => 'required|string|max:20000',
            'institusi' => 'nullable|string|max:255',
        ], [
            'daftar.required' => 'Isi minimal satu nama.',
        ]);

        $dibuat = 0;
        foreach (preg_split('/\R/', $data['daftar']) as $baris) {
            $bagian = array_map('trim', explode('|', $baris, 2));
            $nama = preg_replace('/\s+/', ' ', $bagian[0] ?? '');
            if ($nama === '') {
                continue;
            }

            SertifikatKhusus::create([
                'nama' => mb_substr($nama, 0, 255),
                'peran' => $data['peran'],
                'institusi' => mb_substr(($bagian[1] ?? '') ?: ($data['institusi'] ?? ''), 0, 255) ?: null,
                'admin_id' => auth()->id(),
            ]);
            $dibuat++;
        }

        if ($dibuat === 0) {
            return back()->withInput()->with('error', 'Tidak ada nama yang valid.');
        }

        return redirect()->route('admin.sertifikat.index', ['peran' => $data['peran']])
            ->with('success', $dibuat . ' sertifikat ' . $data['peran'] . ' berhasil dibuat. Klik "Lihat & Unduh" untuk mengunduhnya.');
    }

    public function sertifikatKhususUpdate(Request $request, SertifikatKhusus $sertifikat)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'peran' => ['required', Rule::in(SertifikatKhusus::PERAN)],
            'institusi' => 'nullable|string|max:255',
        ]);

        $sertifikat->update($data);

        return back()->with('success', 'Sertifikat ' . $sertifikat->nomor() . ' diperbarui.');
    }

    public function sertifikatKhususShow(SertifikatKhusus $sertifikat)
    {
        return view('peserta.sertifikat_preview', [
            'nama_peserta' => $sertifikat->nama,
            'peran_peserta' => $sertifikat->peran,
            'nomor_unik' => $sertifikat->nomor(),
            'tanggal_acara' => '1 - 2 Desember 2026',
            'tempat_acara' => 'The Malioboro Hotel, Yogyakarta',
            'tema' => 'AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi',
            'qr_verifikasi' => Verifikasi::qr('K', $sertifikat->id),
            'url_verifikasi' => Verifikasi::url('K', $sertifikat->id),
            'kembali_url' => route('admin.sertifikat.index', ['peran' => $sertifikat->peran]),
        ]);
    }

    public function sertifikatKhususDestroy(SertifikatKhusus $sertifikat)
    {
        $nomor = $sertifikat->nomor();
        $sertifikat->delete();

        return back()->with('success', 'Sertifikat ' . $nomor . ' dihapus. QR pada sertifikat tersebut kini tidak berlaku.');
    }
}
