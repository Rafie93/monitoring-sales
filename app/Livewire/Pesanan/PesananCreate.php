<?php

namespace App\Livewire\Pesanan;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\PesananKendaraan;
use App\Models\Sales;
use App\Models\Tipe;
use Livewire\Component;

class PesananCreate extends Component
{
    public $no_spk,$role,$id_pesanan;
    public $id_customer,$id_sales;
    public $id_mobil,$warna;
    public $tipe_plat="Putih";
    public $stnk_alamat;
    public $harga=0,$harga_total=0;
    public $tanggal_pesanan;
    public $jumlah_unit=1;
    public $diskon=0;
    public $total=0;
    public $status_pesanan="Draft";
    public $status_pembayaran="Belum Bayar";    
    public $alamat_ktp,$alamat_domisili,$stnk_nama,$stnk_nik;
    public $warnas=[];
    public function mount($id_pesanan=null){
        $this->tanggal_pesanan = date('Y-m-d');
        $this->getNoSPK();
        $user = auth()->user();
        $this->role = $user->role;
        if($this->role==2){
            $this->id_sales = Sales::where('id_user',$user->id)->first()->id;
        }
        if($id_pesanan){
            $pesanan = PesananKendaraan::find($id_pesanan);
            $this->id_pesanan = $id_pesanan;
            $this->no_spk = $pesanan->no_spk;
            $this->id_customer = $pesanan->id_customer;
            $this->id_mobil = $pesanan->id_mobil;
            $this->tipe_plat = $pesanan->tipe_plat;
            $this->stnk_alamat = $pesanan->stnk_alamat;
            $this->harga = $pesanan->harga;
            $this->tanggal_pesanan = $pesanan->tanggal_pesanan;
            $this->jumlah_unit = $pesanan->jumlah_unit;
            $this->diskon = $pesanan->diskon;
            $this->total = $pesanan->total;
            $this->status_pesanan = $pesanan->status_pesanan;
            $this->status_pembayaran = $pesanan->status_pembayaran;
            $this->id_sales = $pesanan->id_sales;
            $this->warna = $pesanan->warna;
            $this->getCustomer();
            $this->getMobil();
            
        }
    }
    public function getNoSPK(){
        $lastcount = PesananKendaraan::whereYear('tanggal_pesanan',date('Y'))
                                        ->whereMonth('tanggal_pesanan',date('m'))
                                        ->count();
        $this->no_spk = date('Ymdhi').$lastcount+1;
    }
    public function render()
    {
        $customers = Customer::all();
        $mobils = Mobil::all();
        $tipes = Tipe::all();
        $sales = Sales::all();
        return view('livewire.pesanan.pesanan-create',compact(
            'customers','mobils','tipes','sales'
        ));
    }
    public function getCustomer(){
        if($this->id_customer){
            $cs = Customer::find($this->id_customer);
            $this->alamat_ktp = $cs->alamat_ktp;
            $this->alamat_domisili = $cs->alamat_domisili;
            $this->stnk_alamat = $this->alamat_ktp;
            $this->stnk_nama = $cs->nama;
            $this->stnk_nik = $cs->no_identitas; 
    
        }
    }
    public function getMobil(){
        if($this->id_mobil){
            $mb = Mobil::find($this->id_mobil);
            $this->harga = $mb->harga;
            $this->warnas =  explode(',', $mb->warna);
            $this->hitung();
    
        }
    }
    public function hitung(){
        $this->harga_total =  ($this->jumlah_unit ? $this->jumlah_unit : 0) * ($this->harga ? $this->harga : 0);
        $this->total = $this->harga_total - ($this->diskon ? $this->diskon : 0);
    }
    public function store()
    {
        $this->validate([
            'no_spk' => 'required',
            'id_customer' => 'required',
            'id_mobil' => 'required',
            'tipe_plat' => 'required',
            'stnk_alamat' => 'required',
            'harga' => 'required',
            'tanggal_pesanan' => 'required',
            'jumlah_unit' => 'required',
            'diskon' => 'required',
            'total' => 'required',
            'id_sales' => 'required',
            'warna' => 'required'
        ]);
        $pesanan = PesananKendaraan::updateOrCreate([
            'id_pesanan' => $this->id_pesanan
        ],
            [
            'no_spk' => $this->no_spk,
            'id_customer' => $this->id_customer,
            'id_mobil' => $this->id_mobil,
            'tipe_plat' => $this->tipe_plat,
            'stnk_alamat' => $this->stnk_alamat,
            'harga' => $this->harga,
            'tanggal_pesanan' => $this->tanggal_pesanan,
            'jumlah_unit' => $this->jumlah_unit,
            'diskon' => $this->diskon,
            'total' => $this->total,
            'status_pesanan' => $this->status_pesanan,
            'status_pembayaran' => $this->status_pembayaran,
            'id_sales' => $this->id_sales,
            'warna' => $this->warna
        ]);

        $this->alertSuccess('BERHASIL DIBUAT, LANJUTKAN KE PEMBAYARAN');
        $this->getNoSPK();
        sleep(1);
        return redirect()->route('pesanan.pembayaran.create',$pesanan->id_pesanan);

    }

    public function alertSuccess($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }
}
