@extends('layouts.admin')
@section('title', 'Kontrol Navigasi Menu & Hero Banner Halaman')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-blot-formatter@1.0.5/dist/quill-blot-formatter.min.js"></script>

<div class="grid lg:grid-cols-12 gap-6">
    <!-- Form Buat Halaman Navigasi & Gambar Hero -->
    <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <h3 class="font-serif font-bold text-lg text-slate-900 mb-1">Tambah Halaman Menu & Hero Banner</h3>
        <p class="text-xs text-slate-500 mb-5">Setiap halaman dapat memiliki gambar Hero Banner yang berbeda-beda.</p>

        <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" onsubmit="document.getElementById('konten-input').value = quill.root.innerHTML;" class="space-y-4">
            @csrf
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Letakkan di Menu Navigasi</label>
                    <select name="menu_induk" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold focus:bg-white focus:border-asasi-navy outline-none">
                        <option value="profil">Dropdown PROFIL</option>
                        <option value="bidang">Dropdown BIDANG</option>
                        <option value="berita">Dropdown BERITA</option>
                        <option value="keanggotaan">Dropdown KEANGGOTAAN</option>
                        <option value="kontak">Menu Utama KONTAK</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Nomor Urut</label>
                    <input type="number" name="urutan" value="1" min="1" max="10" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Judul Menu / Halaman *</label>
                    <input type="text" name="judul" required placeholder="Contoh: Sejarah & Visi Misi" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Sub-Judul di Hero Banner</label>
                    <input type="text" name="hero_subtitle" placeholder="Contoh: Mengenal Lebih Dekat ASASI" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-asasi-navy outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Upload Gambar Hero Banner Khusus Halaman Ini (Maks 2MB)</label>
                <input type="file" name="hero_image" accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-slate-600 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-asasi-navy file:text-white hover:file:bg-slate-800">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Isi Konten Halaman</label>
                <div id="editor-container" class="bg-white rounded-b-xl" style="height: 220px;"></div>
                <input type="hidden" name="konten" id="konten-input">
            </div>

            <button type="submit" class="w-full bg-asasi-navy hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl text-sm shadow-sm transition">
                + Simpan Halaman & Pasang di Navbar
            </button>
        </form>
    </div>

    <!-- Tabel Daftar Halaman Navigasi -->
    <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden h-fit">
        <div class="p-4 border-b border-slate-100 bg-slate-50/70">
            <h3 class="font-bold text-xs text-slate-700 uppercase tracking-wider">Daftar Semua Halaman Navigasi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Menu</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Judul & Hero</th>
                        <th class="px-4 py-3 text-right text-[11px] font-bold text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pages as $p)
                    <tr>
                        <td class="px-4 py-3.5">
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full uppercase bg-slate-100 text-asasi-navy">
                                {{ $p->menu_induk }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5">
                            <a href="{{ route('page.show', $p->slug) }}" target="_blank" class="font-bold text-slate-900 hover:underline block">{{ $p->judul }}</a>
                            <span class="text-[11px] {{ $p->hero_image ? 'text-emerald-600' : 'text-slate-400' }}">
                                {{ $p->hero_image ? '✓ Custom Hero Image' : '• Default Hero Banner' }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5 text-right">
                            <a href="{{ route('admin.pages.edit', $p->id) }}" class="text-xs text-asasi-navy hover:underline font-bold mr-3">Edit</a>
                            <form action="{{ route('admin.pages.delete', $p->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-rose-600 hover:underline font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-10 text-center text-slate-400 text-xs">Belum ada halaman navigasi yang dibuat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    Quill.register('modules/blotFormatter', QuillBlotFormatter.default);

    const quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Ketikkan isi halaman di sini. Klik ikon gambar di toolbar untuk menyisipkan foto/bagan struktur organisasi...',
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

                            try {
                                const response = await fetch('{{ route("admin.editor.upload") }}', {
                                    method: 'POST',
                                    body: formData
                                });
                                const data = await response.json();
                                if (data.url) {
                                    const range = quill.getSelection(true);
                                    quill.insertEmbed(range.index, 'image', data.url);
                                    quill.setSelection(range.index + 1);
                                }
                            } catch (e) {
                                alert('Gagal mengunggah gambar. Pastikan ukuran gambar di bawah 3MB.');
                            }
                        };
                    }
                }
            }
        }
    });
</script>
@endsection