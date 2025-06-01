<?php

namespace App\Livewire;

use App\Models\Absensi;
use App\Models\Pembayaran;
use App\Models\Pencapaian;
use App\Models\PesananKendaraan;
use App\Models\Sales;
use Illuminate\Http\Request;
use Livewire\Component;

class LaporanConroller extends Component
{
    public $type_laporan,$tahun,$bulan,$id_sales;
    
    public function mount($jenis){
        $this->type_laporan=$jenis;
        $this->tahun = date('Y');
        $bulannya = intval(date('m')) - 1 ;
        if ($bulannya < 1) {
            $bulannya = 12;
            $this->tahun = date('Y')-1;
        }
        $this->bulan =  $bulannya < 10 ? "0".$bulannya : $bulannya;
    }
    public function render()
    {
        $sales = Sales::all();
        return view('livewire.laporan-conroller',compact('sales'));
    }

    public function print(){
        if($this->type_laporan=='laporan-pesanan'){
            return redirect()->route(
                'laporan.pesanan',
                [
                    'tahun' => $this->tahun,
                    'bulan' => $this->bulan
                ]
            );
        }elseif($this->type_laporan=='laporan-pembayaran'){
            return redirect()->route(
                'laporan.pembayaran',
                [
                    'tahun' => $this->tahun,
                    'bulan' => $this->bulan
                ]
            );
        }elseif($this->type_laporan=='laporan-kehadiran'){
            return redirect()->route(
                'laporan.kehadiran',
                [
                    'tahun' => $this->tahun,
                    'bulan' => $this->bulan
                ]
            );
        }elseif($this->type_laporan=='laporan-pencapaian'){
            return redirect()->route(
                'laporan.pencapaian',
                [
                    'tahun' => $this->tahun,
                    'bulan' => $this->bulan
                ]
            );
        }elseif($this->type_laporan=='laporan-pencapaian-sales'){
            $this->validate([
                'id_sales' => 'required'
            ]);
            return redirect()->route(
                'laporan.pencapaian-sales',
                [
                    'sales' => $this->id_sales
                ]
            );
        }
    }

    public function pdfPesanan(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $data = PesananKendaraan::orderBy('tanggal_pesanan','asc')
                    ->when($tahun, function($query) use ($tahun){
                        return $query->whereYear('tanggal_pesanan',$tahun);
                    })
                    ->when($bulan, function($query) use ($bulan){
                        return $query->whereMonth('tanggal_pesanan',$bulan);
                    })
                    ->get();
        return view('livewire.laporan.lap-pesanan',compact('tahun','bulan','data'));
    }
    public function pdfPembayaran(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $data = Pembayaran::orderBy('created_at','asc')
                    ->when($tahun, function($query) use ($tahun){
                        return $query->whereYear('created_at',$tahun);
                    })
                    ->when($bulan, function($query) use ($bulan){
                        return $query->whereMonth('created_at',$bulan);
                    })
                    ->get();
        return view('livewire.laporan.lap-pembayaran',compact('tahun','bulan','data'));
    }
    public function pdfPencapaian(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $data = Pencapaian::when($tahun, function($query) use ($tahun){
                        return $query->where('tahun',$tahun);
                    })
                    ->when($bulan, function($query) use ($bulan){
                        return $query->where('bulan',$bulan);
                    })
                    ->get();
        return view('livewire.laporan.lap-pencapaian',compact('tahun','bulan','data'));

    }
    public function pdfPencapaiansales(Request $request){
        $id_sales = $request->sales;
        $data = Pencapaian::orderBy('tahun','desc')
                    ->orderBy('bulan','desc')
                    ->where('id_sales',$id_sales)->get();

        $nama = Sales::find($id_sales)->nama;
        return view('livewire.laporan.lap-pencapaian-sales',compact('id_sales','data','nama'));
    }
    public function pdfKehadiran(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $data = Sales::all();
        return view('livewire.laporan.lap-kehadiran',compact('tahun','bulan','data'));
    }
}
