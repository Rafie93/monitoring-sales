<?php

namespace App\Livewire\Absensi;

use App\Models\Absensi;
use App\Models\Sales;
use Livewire\Component;
use Livewire\WithFileUploads;

class AbsensiCreate extends Component
{
    use WithFileUploads;
    public $id_sales, $tanggal,$jam_now,$image, $jam_masuk, $jam_keluar,$sales,$button_enable = true;
    public $is_check_in = true,$display_check="CHECK IN",$role;

    protected $listeners = ['imageUpload'];

    public function mount(){
        $this->tanggal = date('Y-m-d');
        $this->jam_now = date('H:i:s');
        $users = auth()->user();
        $this->role = $users->role;
        // if($users->role != 2){
        //     $this->alertError('Hanya Salesman yang dapat mengakses halaman ini');
        //     // sleep(2);
        //    return redirect()->route('absensi');
        // }
    }
    public function render()
    {
        $this->getData();
        $salesman = Sales::get();
        // dd($sales);
        return view('livewire.absensi.absensi-create',compact('salesman'));
    }
    public function getData(){
        $absensi = Absensi::where('id_sales', $this->id_sales)->where('tanggal', date('Y-m-d'))->first();
        if ($absensi) {
            $this->is_check_in = false;
            $jam_keluar = $absensi->jam_keluar;
            if ($jam_keluar == null) {
              $this->display_check = "CHECK OUT";
            } else {
                $this->display_check = "ANDA SUDAH CHECK OUT";
                $this->button_enable = false;
            }
        } else {
            $this->is_check_in = true;
            $this->display_check = "CHECK IN";
        }
    }

    public function imageUpload($dataUri)
    {
        $this->image = $dataUri;
    }

    public function refresh(){
        return redirect()->route('absensi.create');
    }

    public function store(){
        $this->validate([
            'id_sales' => 'required',
            'tanggal' => 'required',           
        ]);
        if ($this->image == null) {
            $this->alertError('Foto tidak boleh kosong');
            return;
        }
        $this->button_enable = false;
        if ($this->is_check_in) {
           
            $data = [
                'id_sales' => $this->id_sales,
                'tanggal' => $this->tanggal,
                'jam_masuk' => date('H:i:s'),
                'foto_masuk' => $this->image, 
                'jam_keluar' => null,
            ];
            $absensi = Absensi::create($data);
            $this->alertSuccess('Absensi Masuk berhasil Check In');
        }else{
            $absensi = Absensi::where('id_sales', $this->id_sales)
                                ->where('tanggal', date('Y-m-d'))->first();
            $absensi->jam_keluar = date('H:i:s');
            $absensi->foto_keluar = $this->image;
            $absensi->save();
            $this->alertSuccess('Absensi Keluar berhasil Check Out');
        }
       
        sleep(1);
        return redirect()->route('absensi');
    }

    public function alertSuccess($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }

    public function alertError($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'error',  'message' => $message]
        );
    }
}
