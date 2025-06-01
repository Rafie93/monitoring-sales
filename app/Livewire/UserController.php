<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserController extends Component
{
    public $openForm = false,$user_id,$name,$password,$role=1,$no_telp,$email;

    public function render()
    {
        $data = User::whereIn('role',[1,3])->get();
        return view('livewire.user-controller',compact('data'));
    }

    public function showForm($id){
        $this->openForm = true;
        $this->user_id=$id;
        $edit = User::find($id);
        $this->name = $edit->name;
        $this->role = $edit->role;
        $this->no_telp = $edit->no_telp;
        $this->email = $edit->email;
        $this->dispatch('show-modal');
    }

    public function store(){
        if ($this->user_id) {
            $this->validate([
                'email' => 'required|unique:users,'.$this->user_id,
                'name' => 'required',
                'role' => 'required',
            ]);
            $user = User::updateOrCreate([
                'id' => $this->user_id
            ],[
                'email' => $this->email,
                'name' => $this->name,
                'role' => $this->role,
                'no_telp' => $this->no_telp,
            ]);
            if($this->password){
                $user->password = bcrypt($this->password);
                $user->save();
            }
            $this->alertSuccess('Data User Berhasil diperbaharui');
        }else{
            $this->validate([
                'email' => 'required|unique:users',
                'name' => 'required',
                'role' => 'required',
                'password' => 'required'
            ]);
            User::Create([
                'email' => $this->email,
                'name' => $this->name,
                'role' => $this->role,
                'no_telp' => $this->no_telp,
                'password' => bcrypt($this->password)
            ]);
            $this->alertSuccess('Data User Berhasil ditambahkan');

        }
       
      
        $this->name = "";
        $this->user_id = "";
        $this->no_telp = "";
        $this->password = "";
        $this->email = "";
        $this->openForm=false;
        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        $cekAdakahAdmin = User::where('role',1)->count();
        $data = User::find($id);
        if($data){
            $rolenya = $data->role;
            if($cekAdakahAdmin==1){
                if ($rolenya==1) {
                    $this->dispatch(
                        'alert',
                        ['type' => 'warning',  'message' => 'Anda Tidak Bisa Menghapus data admin ini karena satu satunya']
                    );
                    return;
                }
            }
            $data->delete();
        }
        $this->alertSuccess('Data USer Berhasil dihapus');
    }

    public function alertSuccess($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }
}
