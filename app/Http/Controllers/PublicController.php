<?php

namespace App\Http\Controllers;

use App\Models\MemberProfile;
use App\Models\Page;
use App\Models\Post;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Output\QRGdImagePNG;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Menampilkan Beranda: Khusus Menampilkan Berita Terbaru (Tidak Berubah Ketika Navigasi Menu)
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.index', compact('posts'));
    }

    // Portal Berita Lengkap (Kategori, Pencarian, Tag, Paginasi, Sidebar)
    public function postsIndex(Request $request)
    {
        $query = Post::where('is_published', true);

        // Filter Kategori
        $selectedCategory = $request->kategori ? strtolower(trim($request->kategori)) : null;
        if ($selectedCategory && in_array($selectedCategory, ['berita', 'kegiatan', 'pengumuman', 'publikasi'])) {
            $query->where('kategori', $selectedCategory);
        }

        // Filter Tag
        $selectedTag = $request->tag ? trim($request->tag) : null;
        if ($selectedTag) {
            $query->where('tags', 'like', '%' . $selectedTag . '%');
        }

        // Pencarian Kata Kunci
        $searchQuery = $request->q ? trim($request->q) : null;
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('judul', 'like', '%' . $searchQuery . '%')
                  ->orWhere('konten', 'like', '%' . $searchQuery . '%')
                  ->orWhere('tags', 'like', '%' . $searchQuery . '%');
            });
        }

        // Berita Utama / Headline (hanya jika di halaman 1 dan tanpa filter/pencarian spesifik)
        $isFirstPage = (int) $request->input('page', 1) === 1;
        $hasFilter = $selectedCategory || $selectedTag || $searchQuery;

        $featuredPost = null;
        if ($isFirstPage && !$hasFilter) {
            $featuredPost = (clone $query)->latest()->first();
            if ($featuredPost) {
                // Jangan duplikasi headline di grid daftar jika sudah jadi headline utama
                $query->where('id', '!=', $featuredPost->id);
            }
        }

        // Paginasi 8 artikel per halaman
        $posts = $query->latest()->paginate(8)->withQueryString();

        // Berita Terkini / Populer untuk Sidebar (5 artikel terbaru)
        $recentPosts = Post::where('is_published', true)->latest()->take(5)->get();

        // Hitung total warta per kategori untuk counter widget
        $categoryCounts = [
            'total'      => Post::where('is_published', true)->count(),
            'berita'     => Post::where('is_published', true)->where('kategori', 'berita')->count(),
            'kegiatan'   => Post::where('is_published', true)->where('kategori', 'kegiatan')->count(),
            'pengumuman' => Post::where('is_published', true)->where('kategori', 'pengumuman')->count(),
            'publikasi'  => Post::where('is_published', true)->where('kategori', 'publikasi')->count(),
        ];

        // Daftar Tags Terpopuler
        $popularTags = Post::where('is_published', true)
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(fn($t) => explode(',', $t))
            ->map(fn($t) => trim($t))
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(12)
            ->keys()
            ->values();

        return view('frontend.posts-index', compact(
            'posts',
            'featuredPost',
            'recentPosts',
            'categoryCounts',
            'popularTags',
            'selectedCategory',
            'selectedTag',
            'searchQuery'
        ));
    }

    // Halaman Khusus Direktori Anggota Nasional & Peneliti
    public function memberDirectory()
    {
        $totalActive = MemberProfile::where('status', 'active')->count();
        $totalInstitutions = MemberProfile::where('status', 'active')->distinct('instansi')->count('instansi');
        $totalDpw = MemberProfile::where('status', 'active')->whereNotNull('wilayah_dpw')->distinct('wilayah_dpw')->count('wilayah_dpw');

        return view('frontend.member-directory', compact('totalActive', 'totalInstitutions', 'totalDpw'));
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

    // Sistem Verifikasi Digital Keaslian Kartu Tanda Anggota (KTA)
    public function verifyKta(Request $request, $nomor = null)
    {
        $queryNomor = trim((string) ($nomor ?: $request->query('nomor', $request->query('q', ''))));

        $member = null;
        $verificationStatus = 'initial'; // initial, valid, expired, pending, rejected, not_found
        $qrBase64 = null;
        $securityHash = null;

        if ($queryNomor !== '') {
            $member = MemberProfile::where('nomor_anggota', $queryNomor)
                ->orWhere('nomor_anggota', strtoupper($queryNomor))
                ->first();

            if (!$member) {
                $verificationStatus = 'not_found';
            } elseif ($member->status === 'active') {
                if ($member->masa_berlaku_sampai && $member->masa_berlaku_sampai->isPast()) {
                    $verificationStatus = 'expired';
                } else {
                    $verificationStatus = 'valid';
                }
            } elseif ($member->status === 'pending') {
                $verificationStatus = 'pending';
            } else {
                $verificationStatus = 'rejected';
            }

            if ($member && $member->nomor_anggota) {
                $securityHash = strtoupper(substr(hash('sha256', "ASASI-SEC-{$member->id}-{$member->nomor_anggota}-{$member->created_at}"), 0, 24));

                try {
                    $verifyUrl = route('kta.verify', ['nomor' => $member->nomor_anggota]);
                    $qrOptions = new QROptions([
                        'outputInterface' => QRGdImagePNG::class,
                        'scale'           => 4,
                        'outputBase64'    => true,
                    ]);
                    $qrBase64 = (new QRCode($qrOptions))->render($verifyUrl);
                } catch (\Throwable $e) {
                    $qrBase64 = null;
                }
            }
        }

        return view('frontend.verify-kta', compact(
            'member',
            'queryNomor',
            'verificationStatus',
            'qrBase64',
            'securityHash'
        ));
    }
}