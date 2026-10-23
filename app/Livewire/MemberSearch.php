<?php

namespace App\Livewire;

use App\Models\MemberProfile;
use Livewire\Component;
use Livewire\WithPagination;

class MemberSearch extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $members = MemberProfile::where('status', 'active')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                      ->orWhere('nomor_anggota', 'like', '%' . $this->search . '%')
                      ->orWhere('instansi', 'like', '%' . $this->search . '%')
                      ->orWhere('wilayah_dpw', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(12);

        return view('livewire.member-search', compact('members'));
    }
}