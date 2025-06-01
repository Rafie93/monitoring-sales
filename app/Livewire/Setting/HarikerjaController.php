<?php

namespace App\Livewire\Setting;

use App\Models\Harikerja;
use Livewire\Component;

class HarikerjaController extends Component
{
    public $openForm = false,$kerja_id,$tahun,$bulan,$jumlah_kerja=22;

    public function mount(){
        $this->tahun = date('Y');
        $this->bulan = date('m');
    }
    public function render()
    {
        $data = Harikerja::orderBy('tahun','desc')->orderBy('bulan','desc')->get();
        return view('livewire.setting.harikerja-controller',compact('data'));
    }
    public function showForm($id){
        $this->openForm = true;
        $this->kerja_id=$id;
        $edit = Harikerja::find($id);
        $this->tahun = $edit->tahun;
        $this->bulan = $edit->bulan;
        $this->dispatch('show-modal');
    }

    public function store(){
        $this->validate([
            'tahun' => 'required',
            'bulan' => 'required',
            'jumlah_kerja' => 'required|numeric'
        ]);
        if(!$this->kerja_id){
          if  (Harikerja::where('tahun',$this->tahun)
                    ->where('bulan',$this->bulan)->count() > 0)
                {
                    $this->dispatch(
                        'alert',
                        ['type' => 'error',  'message' => 'Periode sudah ada']
                    );
                    return;
                }
        }
        Harikerja::updateOrCreate([
            'id' => $this->kerja_id
        ],[
            'tahun' => $this->tahun,
            'bulan' => $this->bulan,
            'jumlah_kerja' => $this->jumlah_kerja
        ]);
        $this->alertSuccess('Hari Kerja Berhasil diperbaharui');
        $this->tahun = date('Y');
        $this->bulan = date('m');
        $this->jumlah_kerja = 22;
        $this->kerja_id = "";
        $this->openForm=false;
        $this->dispatch('close-modal');
    }

    public function delete($id){
       
        $data = Harikerja::find($id);
        if($data){
            $data->delete();
        }
        $this->alertSuccess('Hari Kerja Berhasil dihapus');
    }

    public function alertSuccess($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }
}
