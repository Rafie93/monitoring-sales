<?php
namespace App\Models;

use App\Models\Absensi;

class KehadiranQuery
{
    public function jumlahHariKerja($tahun,$bulan){
        $cekHariKerja = Harikerja::where('tahun',$tahun)->where('bulan',$bulan)->first();
        if($cekHariKerja){
            return $cekHariKerja->jumlah_kerja;
        }else{
            return 22;
        }

    }
    public function getKehadiran($id_sales, $date)
    {
        $absensi = Absensi::orderBy('jam_masuk', 'asc')
            ->where('id_sales', $id_sales)
            ->whereDate('tanggal', $date)
            ->first();
     
        return $absensi ? 'H' : null;
    }

   

}