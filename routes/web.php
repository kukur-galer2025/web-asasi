<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;

// 1. RUTE PUBLIK
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/halaman/{slug}', [PublicController::class, 'showPage'])->name('page.show');
Route::get('/berita/{slug}', [PublicController::class, 'showPost'])->name('post.show');

Route::get('/daftar-anggota', [MemberController::class, 'redirectRegister'])->name('register.member');

// 2. RUTE AUTENTIKASI & GOOGLE LOGIN
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/google', [AuthController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback']);

// 3. RUTE TERPROTEKSI (Wajib Login)
Route::middleware('auth')->group(function () {

    // Area Member
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
    Route::post('/member/profile', [MemberController::class, 'saveProfile'])->name('member.profile.save');
    Route::get('/member/cetak-kta', [MemberController::class, 'cetakKta'])->name('member.cetak.kta');

    // Area Admin
    Route::get('/admin/members', [AdminController::class, 'members'])->name('admin.members');
    Route::post('/admin/members/{id}/approve', [AdminController::class, 'approveMember'])->name('admin.approve');
    Route::get('/admin/members/{id}/cetak-kta', [AdminController::class, 'cetakKta'])->name('admin.cetak.kta');

    // Kelola Berita + Upload Hero
    // Kelola Berita + Edit + Upload Hero
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::post('/admin/posts', [AdminController::class, 'storePost'])->name('admin.posts.store');
    Route::get('/admin/posts/{id}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
    Route::put('/admin/posts/{id}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
    Route::delete('/admin/posts/{id}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    
    // Kelola Sub-Menu Navbar + Upload Hero
    Route::get('/admin/pages', [AdminController::class, 'pages'])->name('admin.pages');
    Route::post('/admin/pages', [AdminController::class, 'storePage'])->name('admin.pages.store');
    Route::get('/admin/pages/{id}/edit', [AdminController::class, 'editPage'])->name('admin.pages.edit');
    Route::put('/admin/pages/{id}', [AdminController::class, 'updatePage'])->name('admin.pages.update');
    Route::delete('/admin/pages/{id}', [AdminController::class, 'deletePage'])->name('admin.pages.delete');

    // Endpoint Khusus Upload Gambar di Dalam Rich Text Editor (Anti-Lag)
    Route::post('/admin/upload-editor-image', [AdminController::class, 'uploadEditorImage'])->name('admin.editor.upload');
});