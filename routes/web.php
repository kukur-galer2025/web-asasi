<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PasswordResetController;

// 1. RUTE PUBLIK
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita', [PublicController::class, 'postsIndex'])->name('posts.index');
Route::get('/direktori-anggota', [PublicController::class, 'memberDirectory'])->name('member.directory');
Route::get('/halaman/{slug}', [PublicController::class, 'showPage'])->name('page.show');
Route::get('/berita/{slug}', [PublicController::class, 'showPost'])->name('post.show');

Route::get('/daftar-anggota', [MemberController::class, 'redirectRegister'])->name('register.member');
Route::get('/verifikasi-kta/{nomor?}', [PublicController::class, 'verifyKta'])->name('kta.verify');

// 2. RUTE AUTENTIKASI & GOOGLE LOGIN
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->middleware('throttle:10,1')->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Lupa & Atur Ulang Kata Sandi
Route::middleware('guest')->group(function () {
    Route::get('/lupa-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
    Route::post('/lupa-password', [PasswordResetController::class, 'sendLink'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->middleware('throttle:5,1')->name('password.update');
});

Route::get('/auth/google', [AuthController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback']);

// 3. RUTE TERPROTEKSI (Wajib Login)
Route::middleware('auth')->group(function () {

    // Notifikasi (lonceng): buka satu notifikasi lalu diarahkan ke tautannya
    Route::get('/notifikasi/{id}', [NotificationController::class, 'open'])->name('notifications.open');

    // Area Member (Khusus Anggota)
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
    Route::post('/member/profile', [MemberController::class, 'saveProfile'])->name('member.profile.save');
    Route::get('/member/cetak-kta', [MemberController::class, 'cetakKta'])->name('member.cetak.kta');
    Route::post('/member/pembayaran', [MemberController::class, 'storePayment'])->name('member.payment.store');

    // Bukti pembayaran (disk privat): pemilik atau admin, dicek oleh MembershipPaymentPolicy
    Route::get('/pembayaran/{payment}/bukti', [MemberController::class, 'buktiPembayaran'])->name('payment.proof');

    // Area Admin (Khusus Pengurus dengan role: admin)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/members', [AdminController::class, 'members'])->name('members');
        Route::post('/members/{id}/approve', [AdminController::class, 'approveMember'])->name('approve');
        Route::get('/members/{id}/cetak-kta', [AdminController::class, 'cetakKta'])->name('cetak.kta');

        // Verifikasi Pembayaran Pendaftaran & Perpanjangan
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
        Route::post('/payments/{payment}/approve', [AdminController::class, 'approvePayment'])->name('payments.approve');
        Route::post('/payments/{payment}/reject', [AdminController::class, 'rejectPayment'])->name('payments.reject');

        // Kelola Berita + Edit + Upload Hero
        Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
        Route::post('/posts', [AdminController::class, 'storePost'])->name('posts.store');
        Route::get('/posts/{id}/edit', [AdminController::class, 'editPost'])->name('posts.edit');
        Route::put('/posts/{id}', [AdminController::class, 'updatePost'])->name('posts.update');
        Route::delete('/posts/{id}', [AdminController::class, 'deletePost'])->name('posts.delete');
        
        // Kelola Sub-Menu Navbar + Upload Hero
        Route::get('/pages', [AdminController::class, 'pages'])->name('pages');
        Route::post('/pages', [AdminController::class, 'storePage'])->name('pages.store');
        Route::get('/pages/{id}/edit', [AdminController::class, 'editPage'])->name('pages.edit');
        Route::put('/pages/{id}', [AdminController::class, 'updatePage'])->name('pages.update');
        Route::delete('/pages/{id}', [AdminController::class, 'deletePage'])->name('pages.delete');

        // Endpoint Khusus Upload Gambar di Dalam Rich Text Editor (Anti-Lag)
        Route::post('/upload-editor-image', [AdminController::class, 'uploadEditorImage'])->name('editor.upload');
    });
});