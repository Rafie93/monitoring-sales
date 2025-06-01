<?php

namespace App\Livewire\Pencapaian;

use App\Models\Pencapaian;
use Livewire\Component;
use Livewire\WithPagination;

class PencapaianData extends Component
{
    use WithPagination;
    public $tahun,$bulan;
    public function mount(){
        $this->tahun = date('Y');
    }
    public function render()
    {
        $data = Pencapaian::orderBy('tahun','desc')
                ->orderBy('bulan','desc')
                ->orderBy('rangking','asc')
                ->when($this->tahun, function ($query) {
                   return  $query->where('tahun',$this->tahun);
                })
                ->when($this->bulan, function ($query) {
                   return  $query->where('bulan',$this->bulan);
                })
                ->paginate(10);

        return view('livewire.pencapaian.pencapaian-data',compact('data'));
    }
}
