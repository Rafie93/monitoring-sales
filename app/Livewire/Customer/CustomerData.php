<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use App\Models\PesananKendaraan;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerData extends Component
{
    use WithPagination;
    
    public $updateMode =false,$id_customer,$nama,$jenis_identitas="KTP",$no_npwp,$no_identitas,$alamat_ktp,$alamat_domisili,$email,$no_hp,$pekerjaan;
    public function render()
    {
        $data = Customer::paginate(10);
        return view('livewire.customer.customer-data',compact('data'));
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'jenis_identitas' => 'required',
            'no_identitas' => 'required',
            'alamat_ktp' => 'required',
            'alamat_domisili' => 'required',
            'no_hp' => 'required'
        ]);
        // Save User 
        
       
        Customer::updateOrCreate([
            'id_customer' => $this->id_customer
        ],[
            'nama' => $this->nama,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
            'alamat_ktp' => $this->alamat_ktp,
            'alamat_domisili' => $this->alamat_domisili,
            'jenis_identitas' => $this->jenis_identitas,
            'no_identitas' => $this->no_identitas,
            'no_npwp' => $this->no_npwp,
            'pekerjaan' => $this->pekerjaan
        ]);
        $this->resetInputFields();
        $this->alertSuccess('Data Customer Berhasil diperbaharui');
        $this->dispatch('close-modal');
    }
    public function alertSuccess($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }

    private function resetInputFields()
    {
        $this->id_customer = '';
        $this->nama = '';
        $this->no_hp = '';
        $this->email = '';
        $this->alamat_ktp = '';
        $this->alamat_domisili = '';
        $this->pekerjaan = "";
        $this->jenis_identitas="";
        $this->no_identitas="";
    }
    public function edit($id)
    {
        $customer = Customer::find($id);
        $this->id_customer = $id;
        $this->nama = $customer->nama;
        $this->no_hp = $customer->no_hp;
        $this->email = $customer->email;
        $this->alamat_domisili = $customer->alamat_domisili;
        $this->alamat_ktp = $customer->alamat_ktp;
        $this->pekerjaan = $customer->pekerjaan;
        $this->jenis_identitas = $customer->jenis_identitas;
        $this->no_identitas = $customer->no_identitas;
        $this->no_npwp = $customer->no_npwp;
        $this->updateMode = true;
        $this->dispatch('show-modal');
    }
    public function delete($id){
        $count = PesananKendaraan::where('id_customer',$id)->count();
        if ($count > 0) {
            $this->dispatch(
                'alert',
                ['type' => 'warning',  'message' => "Data Tidak dapat dihapus terkait pada Pesanan"]
            );
            return;
        }
        $data = Customer::find($id);
        if($data){
            $data->delete();
        }
        $this->alertSuccess('Data Pekerjaan Berhasil dihapus');
    }
}
