<?php

namespace App\Livewire\Master;

use App\Models\Mobil;
use App\Models\PesananKendaraan;
use App\Models\Tipe;
use Livewire\Component;
use Livewire\WithPagination;

class MobilController extends Component
{
    use WithPagination;
    public $id_tipe;
    public $sub_tipe;
    public $tahun;
    public $warna;
    public $jenis_transmisi="Manual";
    public $kapasitas_mesin="900";
    public $tempat_duduk=4;
    public $harga=0;
    public $tipes;
    public $mobil_id;
    public $updateMode = false;
    public $warnas=[];
    public $warnaSelected=[];

    public function mount(){
        $this->tipes = Tipe::all();
        $this->warnas=[
            'Putih','Hitam','Merah','Biru','Kuning','Hijau'
        ];
    }
    public function render()
    {
        $data = Mobil::paginate(10);
        return view('livewire.master.mobil-controller',
        compact('data'));
    }

    public function store(){
        $this->validate([
            'id_tipe' => 'required',
            'sub_tipe' => 'required',
            'tahun' => 'required',
            'warnaSelected' => 'required',
            'jenis_transmisi' => 'required',
            'kapasitas_mesin' => 'required',
            'tempat_duduk' => 'required',
            'harga' => 'required',
        ]);
        Mobil::updateOrCreate([
            'id_mobil' => $this->mobil_id
        ],[
            'id_tipe' => $this->id_tipe,
            'sub_tipe' => $this->sub_tipe,
            'tahun' => $this->tahun,
            'warna' => implode(',', $this->warnaSelected),
            'jenis_transmisi' => $this->jenis_transmisi,
            'kapasitas_mesin' => $this->kapasitas_mesin,
            'tempat_duduk' => $this->tempat_duduk,
            'harga' => $this->harga,
        ]);
        $this->resetInputFields();
        $this->alertSuccess('Data Mobil Berhasil diperbaharui');
        $this->dispatch('close-modal');
  
    }

    public function edit($id)
    {
        $record = Mobil::findOrFail($id);
        $this->mobil_id = $id;
        $this->id_tipe = $record->id_tipe;
        $this->sub_tipe = $record->sub_tipe;
        $this->tahun = $record->tahun;
        $this->warnaSelected = explode(',', $record->warna);
        $this->jenis_transmisi = $record->jenis_transmisi;
        $this->kapasitas_mesin = $record->kapasitas_mesin;
        $this->tempat_duduk = $record->tempat_duduk;
        $this->harga = $record->harga;
        $this->updateMode = true;
        $this->dispatch('show-modal');

    }

    public function update()
    {
        $this->validate([
            'id_tipe' => 'required',
            'sub_tipe' => 'required',
            'tahun' => 'required',
            'warna' => 'required',
            'jenis_transmisi' => 'required',
            'kapasitas_mesin' => 'required',
            'tempat_duduk' => 'required',
            'harga' => 'required',
        ]);
        if ($this->mobil_id) {
            $record = Mobil::find($this->mobil_id);
            $record->update([
                'id_tipe' => $this->id_tipe,
                'sub_tipe' => $this->sub_tipe,
                'tahun' => $this->tahun,
                'warna' => $this->warna,
                'jenis_transmisi' => $this->jenis_transmisi,
                'kapasitas_mesin' => $this->kapasitas_mesin,
                'tempat_duduk' => $this->tempat_duduk,
                'harga' => $this->harga,
            ]);
            $this->resetInputFields();
            $this->updateMode = false;
            session()->flash('message', 'Data mobil berhasil diupdate!');
        }

    }

    public function resetInputFields()
    {
        $this->id_tipe = '';
        $this->sub_tipe = '';
        $this->tahun = '';
        $this->warna = '';
        $this->jenis_transmisi = '';
        $this->kapasitas_mesin = '';
        $this->tempat_duduk = '';
        $this->harga = '';
        $this->mobil_id="";
    }
    public function delete($id){
        $count = PesananKendaraan::where('id_mobil',$id)->count();
        if ($count > 0) {
            $this->dispatch(
                'alert',
                ['type' => 'warning',  'message' => "Data Tidak dapat dihapus terkait pada Pesanan"]
            );
            return;
        }
        $data = Mobil::find($id);
        if($data){
            $data->delete();
        }
        $this->alertSuccess('Mobil Berhasil dihapus');
    }
    public function alertSuccess($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }
}
