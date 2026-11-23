<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\VerifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes - STARNAS ASASI & ICoABCD 2026
|--------------------------------------------------------------------------
|
| Pemetaan rute aplikasi STARNAS ASASI & ICoABCD 2026:
| 1. Public & Informasi Umum (Landing page, rundown, panduan)
| 2. Guest Authentication (Login, Register)
| 3. Authenticated Routes (Logout, Admin Portal, Peserta Portal)
|
*/

// =========================================================================
// 1. PUBLIC ROUTES (Bebas diakses tanpa login)
// =========================================================================

// Halaman Utama / Landing Page
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'peserta') {
            return redirect()->route('peserta.beranda');
        }
    }

    return view('homepage');
})->name('home');

// Informasi Publik, Komite & Rundown Acara
Route::view('/panduan-penulisan', 'peserta.panduan-penulisan')->name('panduan.penulisan');
Route::view('/peer-review', 'peserta.peer-review')->name('peer.review');
Route::view('/komite', 'peserta.komite')->name('komite');
Route::view('/rundown-starnas', 'peserta.rundown_starnas')->name('rundown.starnas');
Route::view('/rundown-rakornas', 'peserta.rundown_rakornas')->name('rundown.rakornas');

// Verifikasi keaslian sertifikat / LoA (hasil scan QR code)
Route::get('/verifikasi/{kode}', [VerifikasiController::class, 'show'])
    ->middleware('throttle:60,1')
    ->where('kode', '[A-Za-z0-9\-]+')
    ->name('verifikasi');


// =========================================================================
// 2. GUEST ROUTES (Khusus pengunjung yang belum login)
// =========================================================================

Route::middleware('guest')->group(function () {
    // Registrasi
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register')->middleware('throttle:10,1');
    });

    // Login & Google OAuth
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->middleware('throttle:10,1');
        Route::get('/auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('/auth/google/callback', 'handleGoogleCallback')->name('auth.google.callback');
    });

    // Lupa password (link reset dikirim lewat email)
    Route::controller(PasswordResetController::class)->group(function () {
        Route::get('/lupa-password', 'showLinkRequestForm')->name('password.request');
        Route::post('/lupa-password', 'sendResetLink')->middleware('throttle:5,1')->name('password.email');
        Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
        Route::post('/reset-password', 'reset')->middleware('throttle:10,1')->name('password.update');
    });
});


// =========================================================================
// 3. AUTHENTICATED ROUTES (Wajib Login)
// =========================================================================

Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // ---------------------------------------------------------------------
    // ADMIN PORTAL (Prefix: /admin | Role: admin)
    // ---------------------------------------------------------------------
    Route::prefix('admin')
        ->middleware('role:admin')
        ->name('admin.')
        ->controller(AdminController::class)
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', 'dashboard')->name('dashboard');

            // Sinkronisasi data masuk (dipoll browser admin)
            Route::get('/status-sinkron', 'statusSinkron')->name('status.sinkron');

            // Manajemen Users (Peserta & Admin)
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', 'manageUsers')->name('index');
                Route::get('/{user}/edit', 'editUser')->name('edit');
                Route::put('/{user}', 'updateUser')->name('update');
            });

            // Manajemen & Verifikasi Pembayaran
            Route::prefix('payments')->name('payments.')->group(function () {
                Route::get('/', 'managePayments')->name('index');
                Route::get('/{pembayaran}', 'showPayment')->name('show');
                Route::post('/{pembayaran}/verify', 'verifyPayment')->name('verify');
                Route::post('/{pembayaran}/reject', 'rejectPayment')->name('reject');
                Route::get('/{pembayaran}/view-bukti', 'viewBuktiPembayaran')->name('view-bukti');
            });

            // Log & Status Email
            Route::prefix('emails')->name('emails.')->group(function () {
                Route::get('/', 'emailLogs')->name('index');
                Route::post('/resend-gagal', 'resendFailedEmails')->name('resend-failed');
                Route::post('/{emailLog}/resend', 'resendEmail')->name('resend');
            });

            // Pengumuman / broadcast ke peserta
            Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
                Route::get('/', 'pengumumanIndex')->name('index');
                Route::post('/', 'pengumumanStore')->name('store');
                Route::delete('/{pengumuman}', 'pengumumanDestroy')->name('destroy');
            });

            // Ekspor Excel
            Route::get('/users/export-excel', 'exportPesertaExcel')->name('users.export-excel');

            // Laporan Pembayaran
            Route::prefix('reports/payments')->name('reports.payments.')->group(function () {
                Route::get('/', 'showPaymentsReport')->name('index');
                Route::get('/export-pdf', 'exportPaymentsPdf')->name('export-pdf');
                Route::get('/export-excel', 'exportPaymentsExcel')->name('export-excel');
            });

            // Manajemen Abstrak
            Route::prefix('abstracts')->name('abstracts.')->group(function () {
                Route::get('/', 'manageAbstracts')->name('index');
                Route::get('/export-excel', 'exportAbstrakExcel')->name('export-excel');
                Route::get('/{abstrak}', 'showAbstract')->name('show');
                Route::post('/{abstrak}/verify', 'verifyAbstract')->name('verify');
                Route::post('/{abstrak}/reject', 'rejectAbstract')->name('reject');
                Route::get('/{abstrak}/download', 'downloadAbstract')->name('download');
            });
        });

    // ---------------------------------------------------------------------
    // PESERTA PORTAL (Prefix: /peserta | Role: peserta)
    // ---------------------------------------------------------------------
    Route::prefix('peserta')
        ->middleware(['role:peserta', 'profil.lengkap'])
        ->name('peserta.')
        ->controller(PesertaController::class)
        ->group(function () {

            // Beranda Peserta
            Route::get('/beranda', 'beranda')->name('beranda');

            // Notifikasi (lonceng)
            Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
                Route::get('/', 'notifikasi')->name('index');
                Route::post('/baca-semua', 'bacaSemuaNotifikasi')->name('baca-semua');
                Route::get('/{notifikasi}/buka', 'bukaNotifikasi')->name('buka');
            });

            // Pengumuman dari panitia
            Route::get('/pengumuman', 'pengumuman')->name('pengumuman');

            // Sinkronisasi status abstrak & pembayaran (dipoll browser)
            Route::get('/status-sinkron', 'statusSinkron')->name('status.sinkron');

            // Manajemen Pembayaran & Upload Bukti
            Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
                Route::get('/cara', 'caraPembayaran')->name('cara');
                Route::get('/upload', 'uploadBukti')->name('upload');
                Route::post('/upload', 'storeBukti')->name('store');
            });

            // Riwayat & Bukti Pembayaran
            Route::get('/riwayat', 'riwayat')->name('riwayat');
            Route::get('/payments/{pembayaran}/view-bukti', 'viewBuktiPembayaranPeserta')->name('payments.view-bukti');

            // Dokumen (Kwitansi, Invoice & Sertifikat)
            Route::get('/kwitansi/{pembayaran}', 'downloadKwitansi')->name('kwitansi.download');
            Route::get('/invoice/{pembayaran}', 'downloadInvoice')->name('invoice.download');
            Route::get('/sertifikat/download', 'generateSertifikat')->name('sertifikat.download');

            // Profil Pengguna
            Route::prefix('profil')->name('profile.')->group(function () {
                Route::get('/edit', 'editProfile')->name('edit');
                Route::put('/update', 'updateProfile')->name('update');
            });

            // Manajemen Abstrak
            Route::prefix('abstrak')->name('abstrak.')->group(function () {
                Route::get('/upload', 'uploadAbstrak')->name('upload');
                Route::post('/upload', 'storeAbstrak')->name('store');
                Route::get('/{abstrak}/download', 'downloadAbstrak')->name('download');
                Route::get('/{abstrak}/loa', 'downloadLoa')->name('loa');
                Route::patch('/{abstrak}/penulis', 'updatePenulis')->name('penulis');
                Route::delete('/{abstrak}/delete', 'deleteAbstrak')->name('delete');
            });
        });
});