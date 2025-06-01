<?php

namespace App\Livewire\Pembayaran;

use App\Models\Pembayaran;
use App\Models\PesananKendaraan;
use Livewire\Component;
use Livewire\WithFileUploads;

class PembayaranCreate extends Component
{
    use WithFileUploads;

    public $id_pesanan,$pesanans;
    public $metode_bayar="Tunai",$jumlah_bayar="0",$keterangan,$bukti_pembayaran;
    public function mount($id_pesanan){
        $this->id_pesanan;
    }
    public function render()
    {
        $this->pesanans = PesananKendaraan::find($this->id_pesanan);
        $list_pembayaran = Pembayaran::where('id_pesanan',$this->id_pesanan)->get();
        return view('livewire.pembayaran.pembayaran-create',compact('list_pembayaran'));
    }

    public function store(){
        $this->validate([
            'id_pesanan' => 'required',
            'metode_bayar' => 'required',
            'jumlah_bayar' => 'required|numeric',
            'keterangan' => 'required',
        ]);
        $maksimal_pembayaran = $this->pesanans->total;
        $sudah_dibayar =  Pembayaran::where('id_pesanan',$this->id_pesanan)->sum('jumlah_bayar');
        if($sudah_dibayar + $this->jumlah_bayar > $maksimal_pembayaran){
            $this->alertError('Pembayaran Kelebihan, Maksimal Pembayaran Rp'.number_format($maksimal_pembayaran));

            return;
        }

        $this->bukti_pembayaran->storeAs('public/bukti', $this->bukti_pembayaran->hashName());

        Pembayaran::create([
            'id_pesanan' => $this->id_pesanan,
            'metode_bayar' => $this->metode_bayar,
            'jumlah_bayar' => $this->jumlah_bayar,
            'keterangan_bayar' => $this->keterangan,
            'bukti_bayar' => $this->bukti_pembayaran->hashName()
        ]);
        $status_pembayaran = "Belum Bayar";
        if($sudah_dibayar + $this->jumlah_bayar == $maksimal_pembayaran){
            $status_pembayaran = "Lunas";
        }else if($sudah_dibayar + $this->jumlah_bayar < $maksimal_pembayaran){
            $status_pembayaran = "Belum Lunas";
        }
        PesananKendaraan::find($this->id_pesanan)->update([
            'status_pembayaran' => $status_pembayaran,
            'status_pesanan' => 'SPK Dibuat'
        ]);

        $this->alertSuccess('PEMBAYARAN BERHASIL DITAMBAHKAN');
        sleep(1);
        return redirect()->route('pesanan');
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
