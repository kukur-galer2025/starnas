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

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPeserta = User::where('role', 'peserta')->count();
        $pendingPayments = Pembayaran::where('status', 'pending')->count();
        
        // Mengambil hitungan Abstrak dari tabel Abstrak
        $pendingAbstractsCount = Abstrak::where('status_abstrak', 'pending')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalPeserta', 'pendingPayments', 'pendingAbstractsCount'));
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
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-Laki', 'Perempuan'])],
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
        
        $paymentsQuery = Pembayaran::with('user')->orderBy('created_at', 'desc');

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
        $pembayaran->load('user');
        return view('admin.payments.show', compact('pembayaran'));
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

        return view('admin.abstracts.show', compact('abstrak'));
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

    public function showPaymentsReport(Request $request)
    {
        $search = $request->input('search');
        
        $paymentsQuery = Pembayaran::with('user')->orderBy('created_at', 'asc'); 

        if ($search) {
            $paymentsQuery->whereHas('user', function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('nomor_handphone', 'like', '%' . $search . '%');
            });
        }
        
        $payments = $paymentsQuery->get();
        
        return view('admin.reports.index', compact('payments', 'search')); 
    }

    public function exportPaymentsPdf()
    {
        $payments = Pembayaran::with('user')->orderBy('created_at', 'asc')->get(); 

        $domain_anda = 'starnas.asasi.or.id'; 

        $logoUrl = "https://" . $domain_anda . "/storage/logo-starnas-asasi.jpeg"; 

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true, 
            'chroot' => public_path(),
        ])->loadView('admin.reports.payments_pdf', compact('payments', 'logoUrl'));
        
        $filename = 'Laporan_Pembayaran_STARNAS_' . now()->format('Ymd_His') . '.pdf';
        
        return $pdf->download($filename);
    }
}