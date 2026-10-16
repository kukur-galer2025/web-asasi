@extends('layouts.admin')
@section('title', 'Edit Artikel Berita')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-blot-formatter@1.0.5/dist/quill-blot-formatter.min.js"></script>

<div class="max-w-4xl mx-auto bg-white p-7 rounded-2xl border border-slate-200/80 shadow-sm">
    <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-6">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Mode Penyuntingan</span>
            <h3 class="font-serif font-bold text-xl text-slate-900 mt-0.5">Edit Berita: {{ $post->judul }}</h3>
        </div>
        <a href="{{ route('admin.posts') }}" class="text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-xl transition">
            ← Batal & Kembali
        </a>
    </div>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" onsubmit="document.getElementById('konten-edit').value = quillEdit.root.innerHTML;" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Judul Berita *</label>
                <input type="text" name="judul" value="{{ old('judul', $post->judul) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Rubrik Kategori</label>
                <select name="kategori" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-asasi-navy outline-none">
                    <option value="berita" {{ $post->kategori === 'berita' ? 'selected' : '' }}>Berita Utama</option>
                    <option value="kegiatan" {{ $post->kategori === 'kegiatan' ? 'selected' : '' }}>Agenda & Kegiatan</option>
                    <option value="pengumuman" {{ $post->kategori === 'pengumuman' ? 'selected' : '' }}>Pengumuman Resmi</option>
                    <option value="publikasi" {{ $post->kategori === 'publikasi' ? 'selected' : '' }}>Publikasi Ilmiah</option>
                </select>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4 items-center">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Tag Berita (Pisahkan dengan Koma)</label>
                <input type="text" name="tags" value="{{ old('tags', $post->tags) }}" placeholder="Contoh: Riset, Seminar, Jurnal" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Ganti Gambar Sampul / Hero (Opsional)</label>
                <input type="file" name="gambar" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-asasi-navy file:text-white">
                @if($post->gambar)
                    <span class="text-[11px] text-emerald-600 mt-1 block">✓ Gambar sampul saat ini sudah terpasang (Kosongkan jika tidak ingin diganti).</span>
                @endif
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Isi Naskah Berita (Klik Gambar untuk Geser Ukuran)</label>
                <span id="upload-status-edit" class="text-[11px] font-bold text-amber-600 hidden">⏳ Mengunggah gambar...</span>
            </div>
            <!-- Isi awal diambil dari konten berita yang sudah ada -->
            <div id="editor-edit" class="bg-white rounded-b-xl" style="height: 360px;">{!! $post->konten !!}</div>
            <input type="hidden" name="konten" id="konten-edit">
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.posts') }}" class="px-5 py-3 rounded-xl border border-slate-200 text-slate-600 text-sm font-bold hover:bg-slate-50">
                Batal
            </a>
            <button type="submit" class="bg-asasi-navy hover:bg-slate-800 text-white font-bold px-8 py-3 rounded-xl text-sm shadow-sm transition">
                Simpan Perubahan Berita
            </button>
        </div>
    </form>
</div>

<script>
    Quill.register('modules/blotFormatter', QuillBlotFormatter.default);

    const quillEdit = new Quill('#editor-edit', {
        theme: 'snow',
        modules: {
            blotFormatter: {},
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

                            const statusEl = document.getElementById('upload-status-edit');
                            statusEl.classList.remove('hidden');

                            try {
                                const response = await fetch('{{ route("admin.editor.upload") }}', {
                                    method: 'POST',
                                    body: formData
                                });
                                const data = await response.json();
                                if (data.url) {
                                    const range = quillEdit.getSelection(true);
                                    quillEdit.insertEmbed(range.index, 'image', data.url);
                                    quillEdit.setSelection(range.index + 1);
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