<?php

namespace App\Livewire\Pesanan;

use App\Models\PesananKendaraan;
use Livewire\Component;
use Livewire\WithPagination;

class PesananData extends Component
{
    use WithPagination;
    public function render()
    {
        $data = PesananKendaraan::latest()->paginate(10);
        return view('livewire.pesanan.pesanan-data',compact('data'));
    }
}
