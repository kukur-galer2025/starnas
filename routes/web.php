<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\AdminController;

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


// =========================================================================
// 2. GUEST ROUTES (Khusus pengunjung yang belum login)
// =========================================================================

Route::middleware('guest')->group(function () {
    // Registrasi
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');
    });

    // Login & Google OAuth
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('/auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('/auth/google/callback', 'handleGoogleCallback')->name('auth.google.callback');
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

            // Laporan Pembayaran
            Route::prefix('reports/payments')->name('reports.payments.')->group(function () {
                Route::get('/', 'showPaymentsReport')->name('index');
                Route::get('/export-pdf', 'exportPaymentsPdf')->name('export-pdf');
            });

            // Manajemen Abstrak
            Route::prefix('abstracts')->name('abstracts.')->group(function () {
                Route::get('/', 'manageAbstracts')->name('index');
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
        ->middleware('role:peserta')
        ->name('peserta.')
        ->controller(PesertaController::class)
        ->group(function () {

            // Beranda Peserta
            Route::get('/beranda', 'beranda')->name('beranda');

            // Manajemen Pembayaran & Upload Bukti
            Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
                Route::get('/cara', 'caraPembayaran')->name('cara');
                Route::get('/upload', 'uploadBukti')->name('upload');
                Route::post('/upload', 'storeBukti')->name('store');
            });

            // Riwayat & Bukti Pembayaran
            Route::get('/riwayat', 'riwayat')->name('riwayat');
            Route::get('/payments/{pembayaran}/view-bukti', 'viewBuktiPembayaranPeserta')->name('payments.view-bukti');

            // Dokumen (Kwitansi & Sertifikat)
            Route::get('/kwitansi/{pembayaran}', 'downloadKwitansi')->name('kwitansi.download');
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
                Route::get('/download', 'downloadAbstrak')->name('download');
                Route::delete('/delete', 'deleteAbstrak')->name('delete');
            });
        });
});