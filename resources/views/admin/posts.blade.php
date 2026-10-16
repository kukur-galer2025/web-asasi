@extends('layouts.admin')
@section('title', 'Manajemen Berita, Kegiatan & Publikasi')

@section('content')
<!-- Quill.js + Plugin Resize Gambar (Blot Formatter) -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-blot-formatter@1.0.5/dist/quill-blot-formatter.min.js"></script>

<div class="grid lg:grid-cols-12 gap-6">
    <!-- Form Tambah Berita -->
    <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm h-fit">
        <h3 class="font-serif font-bold text-lg text-slate-900 mb-1">Terbitkan Naskah Berita Baru</h3>
        <p class="text-xs text-slate-500 mb-5">Klik pada gambar di dalam editor untuk menggeser ukurannya (memperbesar/memperkecil) secara bebas.</p>

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" onsubmit="document.getElementById('konten-berita').value = quillPost.root.innerHTML;" class="space-y-4">
            @csrf
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Judul Berita / Kegiatan *</label>
                    <input type="text" name="judul" required placeholder="Contoh: Simposium Nasional Sains 2026" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Rubrik Kategori</label>
                    <select name="kategori" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-asasi-navy outline-none">
                        <option value="berita">Berita Utama</option>
                        <option value="kegiatan">Agenda & Kegiatan</option>
                        <option value="pengumuman">Pengumuman Resmi</option>
                        <option value="publikasi">Publikasi Ilmiah</option>
                    </select>
                </div>
            </div>

            <!-- Input Manual Tag Berita & Upload Gambar Sampul -->
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Tag Berita (Pisahkan dengan Koma)</label>
                    <input type="text" name="tags" placeholder="Contoh: Riset, Seminar, Jurnal, BRIN" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Gambar Sampul / Hero (Maks 3MB)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-asasi-navy file:text-white hover:file:bg-slate-800">
                </div>
            </div>

            <!-- Rich Text Editor dengan Fitur Drag-Resize Gambar -->
            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Isi Naskah Berita (Klik Gambar untuk Ubah Ukuran)</label>
                    <span id="upload-status" class="text-[11px] font-bold text-amber-600 hidden">⏳ Mengunggah gambar...</span>
                </div>
                <div id="editor-berita" class="bg-white rounded-b-xl" style="height: 320px;"></div>
                <input type="hidden" name="konten" id="konten-berita">
            </div>

            <button type="submit" class="w-full bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl text-sm shadow-sm transition">
                + Tayangkan Berita Sekarang
            </button>
        </form>
    </div>

    <!-- Tabel Arsip Berita + Tombol Edit & Hapus -->
    <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden h-fit">
        <div class="p-4 border-b border-slate-100 bg-slate-50/70">
            <h3 class="font-bold text-xs text-slate-700 uppercase tracking-wider">Arsip Berita Terpublikasi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Berita & Tag</th>
                        <th class="px-4 py-3 text-right text-[11px] font-bold text-slate-500 uppercase">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($posts as $post)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-4 py-3.5">
                            <div class="flex items-start gap-3">
                                @if($post->gambar)
                                    <img src="{{ asset('storage/' . $post->gambar) }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200 shrink-0 mt-0.5">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-400 shrink-0 mt-0.5">NO IMG</div>
                                @endif
                                <div>
                                    <span class="px-2 py-0.5 text-[9px] font-bold rounded bg-slate-100 text-asasi-navy uppercase">{{ $post->kategori }}</span>
                                    <a href="{{ route('post.show', $post->slug) }}" target="_blank" class="font-bold text-slate-900 hover:underline line-clamp-1 mt-1 block">{{ $post->judul }}</a>
                                    @if($post->tags)
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach(explode(',', $post->tags) as $tag)
                                                <span class="text-[10px] bg-amber-50 text-amber-800 border border-amber-200/60 px-1.5 py-0.2 rounded">#{{ trim($tag) }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3.5 text-right whitespace-nowrap align-top">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="inline-block text-xs bg-slate-100 hover:bg-asasi-navy hover:text-white text-slate-700 px-3 py-1.5 rounded-lg font-bold transition mr-1">
                                Edit
                            </a>
                            <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-600 px-2.5 py-1.5 rounded-lg font-bold transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-4 py-10 text-center text-slate-400 text-xs">Belum ada berita yang diterbitkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Daftarkan modul BlotFormatter agar gambar bisa di-drag & resize ukurannya
    Quill.register('modules/blotFormatter', QuillBlotFormatter.default);

    const quillPost = new Quill('#editor-berita', {
        theme: 'snow',
        placeholder: 'Tuliskan isi berita lengkap di sini. Klik gambar yang sudah masuk untuk mengatur ukurannya...',
        modules: {
            blotFormatter: {}, // Mengaktifkan fitur tarik ukuran gambar
            toolbar: {
                container: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }, 'blockquote'],
                    ['link', 'image', 'video'],
                    ['clean']
                ],
                handlers: {
                    image: function () {
                        const input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');
                        input.click();

                        input.onchange = async () => {
                            const file = input.files[0];
                            if (!file) return;

                            const formData = new FormData();
                            formData.append('image', file);
                            formData.append('_token', '{{ csrf_token() }}');

                            const statusEl = document.getElementById('upload-status');
                            statusEl.classList.remove('hidden');

                            try {
                                const response = await fetch('{{ route("admin.editor.upload") }}', {
                                    method: 'POST',
                                    body: formData
                                });
                                const data = await response.json();
                                if (data.url) {
                                    const range = quillPost.getSelection(true);
                                    quillPost.insertEmbed(range.index, 'image', data.url);
                                    quillPost.setSelection(range.index + 1);
                                }
                            } catch (e) {
                                alert('Gagal mengunggah gambar.');
                            } finally {
                                statusEl.classList.add('hidden');
                            }
                        };
                    }
                }
            }
        }
    });
</script>
@endsection