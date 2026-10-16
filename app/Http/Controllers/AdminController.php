<?php

namespace App\Http\Controllers;

use App\Models\MemberProfile;
use App\Models\Page;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // 1. MANAJEMEN ANGGOTA & KTA
    public function members()
    {
        $members = MemberProfile::latest()->get();
        return view('admin.members', compact('members'));
    }

    public function approveMember($id)
    {
        $member = MemberProfile::findOrFail($id);

        $tahun = date('Y');
        $prefix = "ASASI-{$tahun}-";
        $lastMember = MemberProfile::where('nomor_anggota', 'like', "{$prefix}%")
            ->orderByDesc('nomor_anggota')
            ->first();

        $nextNumber = $lastMember
            ? ((int) substr($lastMember->nomor_anggota, -4)) + 1
            : 1;

        $nomorKta = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $member->update([
            'nomor_anggota'       => $nomorKta,
            'status'              => 'active',
            'masa_berlaku_sampai' => now()->addYear(),
        ]);

        return redirect()->back()->with('success', "Pengajuan disetujui! Nomor KTA diterbitkan: {$nomorKta}");
    }

    public function cetakKta($id)
    {
        $member = MemberProfile::findOrFail($id);

        if ($member->status !== 'active') {
            return redirect()->back()->with('success', 'Setujui anggota terlebih dahulu sebelum mencetak KTA.');
        }

        $pdf = Pdf::loadView('pdf.kta', compact('member'))
                  ->setPaper([0, 0, 325, 204], 'portrait');

        return $pdf->stream("KTA-{$member->nomor_anggota}.pdf");
    }

    // 2. MANAJEMEN BERITA & KEGIATAN (DENGAN GAMBAR HERO & RICH TEXT)
 // 2. MANAJEMEN BERITA & KEGIATAN (TAMBAH, EDIT, TAGS, & HAPUS)
    public function posts()
    {
        $posts = Post::latest()->get();
        return view('admin.posts', compact('posts'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|in:berita,kegiatan,pengumuman,publikasi',
            'tags'     => 'nullable|string|max:255',
            'gambar'   => 'nullable|image|max:3072',
            'konten'   => 'required|string',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('posts', 'public');
        }

        Post::create([
            'judul'        => $request->judul,
            'slug'         => Str::slug($request->judul) . '-' . Str::random(4),
            'kategori'     => $request->kategori,
            'tags'         => $request->tags,
            'gambar'       => $gambarPath,
            'konten'       => $request->konten,
            'is_published' => true,
        ]);

        return redirect()->route('admin.posts')->with('success', 'Artikel berita berhasil diterbitkan!');
    }

    // Menampilkan Halaman Edit Berita
    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts-edit', compact('post'));
    }

    // Menyimpan Perubahan Edit Berita
    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|in:berita,kegiatan,pengumuman,publikasi',
            'tags'     => 'nullable|string|max:255',
            'gambar'   => 'nullable|image|max:3072',
            'konten'   => 'required|string',
        ]);

        $gambarPath = $post->gambar;
        if ($request->hasFile('gambar')) {
            if ($post->gambar) {
                Storage::disk('public')->delete($post->gambar);
            }
            $gambarPath = $request->file('gambar')->store('posts', 'public');
        }

        $post->update([
            'judul'    => $request->judul,
            'kategori' => $request->kategori,
            'tags'     => $request->tags,
            'gambar'   => $gambarPath,
            'konten'   => $request->konten,
        ]);

        return redirect()->route('admin.posts')->with('success', 'Perubahan artikel berita berhasil disimpan!');
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        if ($post->gambar) {
            Storage::disk('public')->delete($post->gambar);
        }
        $post->delete();

        return redirect()->back()->with('success', 'Artikel berita berhasil dihapus.');
    }

    // 3. MANAJEMEN SUB-MENU NAVBAR & HERO HALAMAN
    public function pages()
    {
        $pages = Page::orderBy('menu_induk')->orderBy('urutan')->get();
        return view('admin.pages', compact('pages'));
    }

    public function storePage(Request $request)
    {
        $request->validate([
            'menu_induk'    => 'required|in:profil,bidang,berita,keanggotaan,kontak',
            'judul'         => 'required|string|max:100',
            'hero_subtitle' => 'nullable|string|max:150',
            'hero_image'    => 'nullable|image|max:3072',
            'konten'        => 'required|string',
            'urutan'        => 'nullable|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('hero_image')) {
            $imagePath = $request->file('hero_image')->store('heroes', 'public');
        }

        Page::create([
            'menu_induk'    => $request->menu_induk,
            'judul'         => $request->judul,
            'slug'          => Str::slug($request->judul) . '-' . Str::random(3),
            'hero_subtitle' => $request->hero_subtitle,
            'hero_image'    => $imagePath,
            'konten'        => $request->konten,
            'urutan'        => $request->urutan ?? 1,
        ]);

        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');

        return back()->with('success', 'Halaman navigasi & Gambar Hero berhasil ditambahkan!');
    }

    public function editPage($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages-edit', compact('page'));
    }

    public function updatePage(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([
            'menu_induk'    => 'required|in:profil,bidang,berita,keanggotaan,kontak',
            'judul'         => 'required|string|max:100',
            'hero_subtitle' => 'nullable|string|max:150',
            'hero_image'    => 'nullable|image|max:3072',
            'konten'        => 'required|string',
            'urutan'        => 'nullable|integer',
        ]);

        $imagePath = $page->hero_image;
        if ($request->hasFile('hero_image')) {
            if ($page->hero_image) {
                Storage::disk('public')->delete($page->hero_image);
            }
            $imagePath = $request->file('hero_image')->store('heroes', 'public');
        }

        // Jika judul berubah, perbarui slug secara otomatis
        $newSlug = $page->slug;
        if ($request->judul !== $page->judul) {
            $newSlug = Str::slug($request->judul) . '-' . Str::random(3);
        }

        $page->update([
            'menu_induk'    => $request->menu_induk,
            'judul'         => $request->judul,
            'slug'          => $newSlug,
            'hero_subtitle' => $request->hero_subtitle,
            'hero_image'    => $imagePath,
            'konten'        => $request->konten,
            'urutan'        => $request->urutan ?? 1,
        ]);

        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');

        return redirect()->route('admin.pages')->with('success', 'Halaman navigasi berhasil diperbarui!');
    }

    public function deletePage($id)
    {
        $page = Page::findOrFail($id);
        if ($page->hero_image) {
            Storage::disk('public')->delete($page->hero_image);
        }
        $page->delete();

        Cache::forget('navbar_pages');
        Cache::forget('navbar_pages_array');

        return back()->with('success', 'Halaman sub-menu berhasil dihapus.');
    }

    // 4. ENDPOINT UPLOAD GAMBAR DI DALAM RICH TEXT EDITOR (QUILL.JS)
    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:3072', // Maks 3MB per gambar di dalam artikel
        ]);

        $path = $request->file('image')->store('editor-images', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}