<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Menampilkan Beranda & Daftar Berita
  public function index(Request $request)
    {
        $posts = Post::where('is_published', true)
            ->when($request->kategori, fn($q) => $q->where('kategori', $request->kategori))
            ->when($request->tag, fn($q) => $q->where('tags', 'like', '%' . $request->tag . '%'))
            ->latest()
            ->get();

        return view('frontend.index', compact('posts'));
    }

    // Menampilkan Halaman Statis Sub-Menu (Profil & Bidang)
    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.page', compact('page'));
    }

    // Menampilkan Baca Detail Berita
    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('frontend.post', compact('post'));
    }
}