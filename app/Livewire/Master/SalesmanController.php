<?php

namespace App\Livewire\Master;

use App\Models\PesananKendaraan;
use App\Models\Sales;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SalesmanController extends Component
{
    use WithPagination;
    public $updateMode =false;
    public $id_user;
    public $nama;
    public $no_telp;
    public $email;
    public $area_sales;
    public $target;
    public $sales_id;
    public function render()
    {
        $sales = Sales::paginate(10);
        return view('livewire.master.salesman-controller',compact('sales'));
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'area_sales' => 'required',
            'target' => 'required',
        ]);
        // Save User 
        if(!$this->updateMode){
            $user = User::create([
                'name' => $this->nama,
                'email' => $this->email,
                'role' => 2,
                'password' =>bcrypt(12345678)
            ]);
            $this->id_user = $user->id;
        }
       
        Sales::updateOrCreate([
            'id_sales' => $this->sales_id
        ],[
            'id_user' => $this->id_user,
            'nama' => $this->nama,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'area_sales' => $this->area_sales,
            'target' => $this->target,
        ]);
        $this->resetInputFields();
        $this->alertSuccess('Data salesman Berhasil Ditambahkan dan password akun  telah diatur dengan no telp sebagai default');
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
        $this->id_user = '';
        $this->nama = '';
        $this->no_telp = '';
        $this->email = '';
        $this->area_sales = '';
        $this->target = '';
        $this->sales_id = "";
    }
    public function edit($id)
    {
        $sales = Sales::find($id);
        $this->sales_id = $id;
        $this->id_user = $sales->id_user;
        $this->nama = $sales->nama;
        $this->no_telp = $sales->no_telp;
        $this->email = $sales->email;
        $this->area_sales = $sales->area_sales;
        $this->target = $sales->target;
        $this->updateMode = true;
        $this->dispatch('show-modal');
    }
    public function delete($id){
        $count = PesananKendaraan::where('id_sales',$id)->count();
        if ($count > 0) {
            $this->dispatch(
                'alert',
                ['type' => 'warning',  'message' => "Data Tidak dapat dihapus terkait pada Pesanan"]
            );
            return;
        }
        $data = Sales::find($id);
        if($data){
            $idUser = $data->id_use;
            $data->delete();
            User::find($idUser)->delete();
        }
        $this->alertSuccess('Data Salesman Berhasil dihapus');
    }
}
