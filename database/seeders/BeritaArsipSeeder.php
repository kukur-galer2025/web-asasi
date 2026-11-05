<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BeritaArsipSeeder extends Seeder
{
    /**
     * Arsip berita asli ASASI dari website WordPress lama (asasi.or.id).
     * Gambar memakai file asli resolusi tertinggi; aman dijalankan berulang (dicocokkan per slug).
     */
    public function run(): void
    {
        $dataDir = database_path('seeders/data');
        $posts = json_decode(File::get("{$dataDir}/berita-arsip.json"), true, flags: JSON_THROW_ON_ERROR);

        foreach (File::files("{$dataDir}/berita-arsip") as $file) {
            Storage::disk('public')->put('posts/arsip/' . $file->getFilename(), File::get($file->getPathname()));
        }

        foreach ($posts as $data) {
            $post = Post::firstOrNew(['slug' => $data['slug']]);
            $post->fill([
                'judul'        => $data['judul'],
                'kategori'     => $data['kategori'],
                'tags'         => $data['tags'],
                'gambar'       => 'posts/arsip/' . $data['gambar'],
                'konten'       => $data['konten'],
                'is_published' => true,
            ]);
            $post->created_at = $data['created_at'];
            $post->updated_at = $data['updated_at'];
            $post->timestamps = false;
            $post->save();
        }

        $this->command?->info('✓ ' . count($posts) . ' berita arsip ASASI berhasil diimpor.');
    }
}
