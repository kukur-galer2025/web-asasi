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