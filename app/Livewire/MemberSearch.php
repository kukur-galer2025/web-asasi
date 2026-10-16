<?php

namespace App\Livewire;

use App\Models\MemberProfile;
use Livewire\Component;

class MemberSearch extends Component
{
    public string $search = '';

    public function render()
    {
        $members = MemberProfile::where('status', 'active')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                      ->orWhere('nomor_anggota', 'like', '%' . $this->search . '%')
                      ->orWhere('instansi', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->take(12)
            ->get();

        return view('livewire.member-search', compact('members'));
    }
}