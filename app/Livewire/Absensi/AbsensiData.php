<?php

namespace App\Livewire\Absensi;

use App\Models\Absensi;
use Livewire\Component;
use Livewire\WithPagination;

class AbsensiData extends Component
{
    use WithPagination;
    public $role;
    public function mount(){
        $users = auth()->user();
        $this->role = $users->role;
    }
    public function render()
    {
        $data = Absensi::orderBy('tanggal','desc')->paginate(10);
        return view('livewire.absensi.absensi-data',compact('data'));
    }
}
