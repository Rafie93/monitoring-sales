<?php

namespace App\Livewire\Master;

use App\Models\Mobil;
use App\Models\Tipe;
use Livewire\Component;

class TipeController extends Component
{
    public $openForm = false,$tipe_id,$tipe;
    public function render()
    {
        $data = Tipe::all();
        return view('livewire.master.tipe-controller',compact('data'));
    }

    public function showForm($id){
        $this->openForm = true;
        $this->tipe_id=$id;
        $edit = Tipe::find($id);
        $this->tipe = $edit->tipe;
        $this->dispatch('show-modal');
    }

    public function store(){
        $this->validate([
            'tipe' => 'required',
        ]);
        Tipe::updateOrCreate([
            'id_tipe' => $this->tipe_id
        ],[
            'tipe' => $this->tipe]);
        $this->alertSuccess('Tipe Mobil Berhasil diperbaharui');
        $this->tipe = "";
        $this->tipe_id = "";
        $this->openForm=false;
        $this->dispatch('close-modal');
    }

    public function delete($id){
        $count = Mobil::where('id_tipe',$id)->count();
        if ($count > 0) {
            $this->dispatch(
                'alert',
                ['type' => 'warning',  'message' => "Data Tidak dapat dihapus terkait pada Mobil"]
            );
            return;
        }
        $data = Tipe::find($id);
        if($data){
            $data->delete();
        }
        $this->alertSuccess('Tipe Mobil Berhasil dihapus');
    }

    public function alertSuccess($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }
}
