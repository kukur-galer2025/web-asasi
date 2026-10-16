@extends('layouts.admin')
@section('title', 'Edit Halaman Navigasi')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-blot-formatter@1.0.5/dist/quill-blot-formatter.min.js"></script>

<div class="max-w-4xl mx-auto bg-white p-7 rounded-2xl border border-slate-200/80 shadow-sm">
    <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-6">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-asasi-gold">Mode Penyuntingan</span>
            <h3 class="font-serif font-bold text-xl text-slate-900 mt-0.5">Edit Halaman: {{ $page->judul }}</h3>
        </div>
        <a href="{{ route('admin.pages') }}" class="text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-xl transition">
            ← Batal & Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-700 rounded-xl px-5 py-3 mb-5 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data"
          onsubmit="document.getElementById('konten-edit').value = quillEdit.root.innerHTML;"
          class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Baris 1: Menu Induk & Urutan --}}
        <div class="grid sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Letakkan di Menu Navigasi</label>
                <select name="menu_induk" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-asasi-navy outline-none">
                    <option value="profil"     {{ old('menu_induk', $page->menu_induk) === 'profil'     ? 'selected' : '' }}>Dropdown PROFIL</option>
                    <option value="bidang"     {{ old('menu_induk', $page->menu_induk) === 'bidang'     ? 'selected' : '' }}>Dropdown BIDANG</option>
                    <option value="berita"     {{ old('menu_induk', $page->menu_induk) === 'berita'     ? 'selected' : '' }}>Dropdown BERITA</option>
                    <option value="keanggotaan"{{ old('menu_induk', $page->menu_induk) === 'keanggotaan'? 'selected' : '' }}>Dropdown KEANGGOTAAN</option>
                    <option value="kontak"     {{ old('menu_induk', $page->menu_induk) === 'kontak'     ? 'selected' : '' }}>Menu Utama KONTAK</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Nomor Urut</label>
                <input type="number" name="urutan" value="{{ old('urutan', $page->urutan) }}" min="1" max="10"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
            </div>
        </div>

        {{-- Baris 2: Judul & Hero Subtitle --}}
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Judul Menu / Halaman *</label>
                <input type="text" name="judul" value="{{ old('judul', $page->judul) }}" required
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Sub-Judul di Hero Banner</label>
                <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $page->hero_subtitle) }}"
                       placeholder="Contoh: Mengenal Lebih Dekat ASASI"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
            </div>
        </div>

        {{-- Baris 3: Upload Gambar Hero --}}
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Ganti Gambar Hero Banner (Opsional, Maks 3MB)</label>
            <input type="file" name="hero_image" accept="image/*"
                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-600 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-asasi-navy file:text-white hover:file:bg-slate-800">
            @if($page->hero_image)
                <div class="mt-2 flex items-center gap-3">
                    <img src="{{ asset('storage/' . $page->hero_image) }}" alt="Hero saat ini"
                         class="h-16 w-28 object-cover rounded-lg border border-slate-200">
                    <span class="text-[11px] text-emerald-600 font-semibold">✓ Gambar hero saat ini sudah terpasang.<br><span class="text-slate-400 font-normal">Kosongkan input di atas jika tidak ingin diganti.</span></span>
                </div>
            @else
                <p class="text-[11px] text-slate-400 mt-1">• Halaman ini belum memiliki custom hero image (akan memakai default).</p>
            @endif
        </div>

        {{-- Baris 4: Konten Editor --}}
        <div>
            <div class="flex justify-between items-center mb-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Isi Konten Halaman</label>
                <span id="upload-status-edit" class="text-[11px] font-bold text-amber-600 hidden">⏳ Mengunggah gambar...</span>
            </div>
            <div id="editor-edit" class="bg-white rounded-b-xl" style="height: 360px;">{!! old('konten', $page->konten) !!}</div>
            <input type="hidden" name="konten" id="konten-edit">
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.pages') }}" class="px-5 py-3 rounded-xl border border-slate-200 text-slate-600 text-sm font-bold hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="bg-asasi-navy hover:bg-slate-800 text-white font-bold px-8 py-3 rounded-xl text-sm shadow-sm transition">
                Simpan Perubahan
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
                                alert('Gagal mengunggah gambar. Pastikan ukuran gambar di bawah 3MB.');
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
