<?php

namespace App\Livewire\Pencapaian;

use App\Models\Absensi;
use App\Models\Harikerja;
use App\Models\Pencapaian;
use App\Models\PesananKendaraan;
use App\Models\Sales;
use Livewire\Component;

class PencapaianCreate extends Component
{
    public $tahun,$bulan,$results=[],$hari_kerja=22,$bobot_penjualan=60,$bobot_absensi=40;

    public function mount(){
        $this->tahun = date('Y');
        $this->bulan = date('m');
    }
    public function render()
    {
        return view('livewire.pencapaian.pencapaian-create');
    }
    public function proses(){
        $sales = Sales::all();
        $this->results=[];
        $cekHariKerja = Harikerja::where('tahun',$this->tahun)
                ->where('bulan',$this->bulan)->first();
        if($cekHariKerja){
            $this->hari_kerja = $cekHariKerja->jumlah_kerja;
        }
        $no=1;
        foreach ($sales as $key => $row) {
            $absensi = Absensi::whereYear('tanggal',$this->tahun)
                    ->whereMonth('tanggal',$this->bulan)
                    ->whereNotNull('jam_masuk')
                    ->where('id_sales',$row->id_sales)
                    ->count();
            $penjualan = PesananKendaraan::where('id_sales',$row->id_sales)
                                    ->whereYear('tanggal_pesanan',$this->tahun)
                                    ->whereMonth('tanggal_pesanan',$this->bulan)
                                    // ->where('status_pesanan','SPK Dibuat')
                                    ->sum('jumlah_unit');
            // dd($penjualan);
            // $absensi = 12;
            // $penjualan = 3;
            $presentasiPenjualan = ($penjualan/$row->target)*100;
            $tidak_hadir = $this->hari_kerja - $absensi;
            $tingkatAbsensi = ($tidak_hadir / $this->hari_kerja) *100;
            $presentasiKehadiran = 100 - $tingkatAbsensi;
            $pencapaian = (($presentasiKehadiran*$this->bobot_absensi)/100) + (($presentasiPenjualan * $this->bobot_penjualan)/100);
            $this->results[$key] = [
                'no' => $no++,
                'id_sales' => $row->id_sales,
                'nama_sales' => $row->nama,
                'hari_kerja' => $this->hari_kerja,
                'kehadiran' => $absensi,
                'tidak_hadir' =>$tidak_hadir,
                'target' => $row->target,
                'penjualan' => $penjualan,
                'presentasiPenjualan' => $presentasiPenjualan,
                'presentasiKehadiran' => $presentasiKehadiran,
                'bobot_penjualan' => $this->bobot_penjualan,
                'bobot_absensi' => $this->bobot_absensi,
                'pencapaian' => $pencapaian,
            ];
        }
    }

    public function store(){
        foreach ($this->results as $key => $value) {
            Pencapaian::updateOrCreate([
                'tahun' => $this->tahun,
                'bulan' => $this->bulan,
                'id_sales' => $value['id_sales'],
            ],
    [
            'tahun' => $this->tahun,
            'bulan' => $this->bulan,
            'id_sales' => $value['id_sales'],
            'target_penjualan' => $value['target'],
            'kehadiran' => $value['kehadiran'],
            'penjualan' => $value['penjualan'],
            'hasil_penjualan' => $value['presentasiPenjualan'],
            'hasil_kehadiran' => $value['presentasiKehadiran'],
            'hasil_pencapaian' => $value['pencapaian'],
            ]);
        }
        // update Ranking
        $dataCapai = Pencapaian::orderBy('hasil_pencapaian','desc')
            ->where('tahun',$this->tahun)
            ->where('bulan',$this->bulan)
            ->get();
        $rank=1;
        foreach ($dataCapai as $key => $res) {
           $res->rangking = $rank;
           $res->save();
           $rank++;
        }
        $this->alertSuccess('Data Pencapaian Berhasil Diupdate');
    }

    public function alertSuccess($message)
    {
        $this->dispatch(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }
}
