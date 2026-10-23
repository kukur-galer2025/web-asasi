<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;

// 1. RUTE PUBLIK
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita', [PublicController::class, 'postsIndex'])->name('posts.index');
Route::get('/halaman/{slug}', [PublicController::class, 'showPage'])->name('page.show');
Route::get('/berita/{slug}', [PublicController::class, 'showPost'])->name('post.show');

Route::get('/daftar-anggota', [MemberController::class, 'redirectRegister'])->name('register.member');
Route::get('/verifikasi-kta/{nomor?}', [PublicController::class, 'verifyKta'])->name('kta.verify');

// 2. RUTE AUTENTIKASI & GOOGLE LOGIN
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google', [AuthController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback']);

// 3. RUTE TERPROTEKSI (Wajib Login)
Route::middleware('auth')->group(function () {

    // Area Member (Khusus Anggota)
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
    Route::post('/member/profile', [MemberController::class, 'saveProfile'])->name('member.profile.save');
    Route::get('/member/cetak-kta', [MemberController::class, 'cetakKta'])->name('member.cetak.kta');

    // Area Admin (Khusus Pengurus dengan role: admin)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/members', [AdminController::class, 'members'])->name('members');
        Route::post('/members/{id}/approve', [AdminController::class, 'approveMember'])->name('approve');
        Route::get('/members/{id}/cetak-kta', [AdminController::class, 'cetakKta'])->name('cetak.kta');

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