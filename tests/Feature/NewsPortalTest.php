<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_successfully_with_latest_news(): void
    {
        Post::create([
            'judul' => 'Berita Terbaru 1',
            'slug' => 'berita-terbaru-1',
            'kategori' => 'berita',
            'konten' => '<p>Konten berita 1</p>',
            'is_published' => true,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Berita Terbaru 1');
        $response->assertSee('Agenda Akademisi');
    }

    public function test_news_portal_page_renders_successfully(): void
    {
        Post::create([
            'judul' => 'Konferensi Nasional 2026',
            'slug' => 'konferensi-nasional-2026',
            'kategori' => 'kegiatan',
            'tags' => 'Scopus, Riset',
            'konten' => '<p>Detail agenda konferensi nasional.</p>',
            'is_published' => true,
        ]);

        $response = $this->get('/berita');
        $response->assertStatus(200);
        $response->assertSee('Portal Warta');
        $response->assertSee('Konferensi Nasional 2026');
        $response->assertSee('Semua Warta');
    }

    public function test_news_portal_filters_by_category(): void
    {
        $kegiatan = Post::create([
            'judul' => 'Berita Kegiatan Akademisi',
            'slug' => 'berita-kegiatan-akademisi',
            'kategori' => 'kegiatan',
            'konten' => '<p>Ini kegiatan</p>',
            'is_published' => true,
        ]);

        $pengumuman = Post::create([
            'judul' => 'Pengumuman Penting Beasiswa',
            'slug' => 'pengumuman-penting-beasiswa',
            'kategori' => 'pengumuman',
            'konten' => '<p>Ini pengumuman</p>',
            'is_published' => true,
        ]);

        $response = $this->get('/berita?kategori=pengumuman');
        $response->assertStatus(200);
        
        $posts = $response->viewData('posts');
        $this->assertTrue($posts->contains('id', $pengumuman->id));
        $this->assertFalse($posts->contains('id', $kegiatan->id));
    }

    public function test_news_portal_searches_by_keyword(): void
    {
        $post1 = Post::create([
            'judul' => 'Studi Genomik Tanaman Obat',
            'slug' => 'studi-genomik-tanaman-obat',
            'kategori' => 'publikasi',
            'tags' => 'Genomik, Farmasi',
            'konten' => '<p>Hasil analisis laboratorium tanaman herbal.</p>',
            'is_published' => true,
        ]);

        $post2 = Post::create([
            'judul' => 'Workshop Robotika Terapan',
            'slug' => 'workshop-robotika-terapan',
            'kategori' => 'kegiatan',
            'tags' => 'Robotika, AI',
            'konten' => '<p>Pelatihan perakitan mikrokontroler.</p>',
            'is_published' => true,
        ]);

        $response = $this->get('/berita?q=Genomik');
        $response->assertStatus(200);

        $posts = $response->viewData('posts');
        $this->assertTrue($posts->contains('id', $post1->id));
        $this->assertFalse($posts->contains('id', $post2->id));
    }

    public function test_news_portal_filters_by_tag(): void
    {
        $post1 = Post::create([
            'judul' => 'Artikel Scopus Q1 Pertama',
            'slug' => 'artikel-scopus-q1-pertama',
            'kategori' => 'publikasi',
            'tags' => 'Scopus, Jurnal',
            'konten' => '<p>Tembus jurnal internasional.</p>',
            'is_published' => true,
        ]);

        $post2 = Post::create([
            'judul' => 'Lomba Karya Ilmiah Mahasiswa',
            'slug' => 'lomba-karya-ilmiah-mahasiswa',
            'kategori' => 'kegiatan',
            'tags' => 'Kompetisi, Mahasiswa',
            'konten' => '<p>Pendaftaran karya tulis dibuka.</p>',
            'is_published' => true,
        ]);

        $response = $this->get('/berita?tag=Scopus');
        $response->assertStatus(200);

        $posts = $response->viewData('posts');
        $this->assertTrue($posts->contains('id', $post1->id));
        $this->assertFalse($posts->contains('id', $post2->id));
    }
}
