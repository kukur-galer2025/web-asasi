<?php

namespace App\Livewire;

use App\Models\MemberProfile;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MemberSearch extends Component
{
    use WithPagination;

    // Disimpan di URL (?cari=) agar hasil bisa dibagikan & tidak hilang saat tombol Back
    #[Url(as: 'cari', except: '')]
    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $term = trim($this->search);

        $members = MemberProfile::where('status', 'active')
            ->when($term !== '', function ($query) use ($term) {
                $like = '%' . addcslashes($term, '%_\\') . '%';
                $query->where(function ($q) use ($like) {
                    $q->where('nama_lengkap', 'like', $like)
                      ->orWhere('nomor_anggota', 'like', $like)
                      ->orWhere('instansi', 'like', $like)
                      ->orWhere('wilayah_dpw', 'like', $like);
                });
            })
            ->latest()
            ->paginate(12);

        return view('livewire.member-search', compact('members'));
    }
}
