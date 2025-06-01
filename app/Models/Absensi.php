<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;


    protected $table = 'absensi'; 

    protected $primaryKey = 'id_absensi'; 

    protected $fillable = ['id_sales', 'tanggal', 'jam_masuk', 'jam_keluar', 'foto_masuk','foto_keluar', 'status'];


    public function sales()

    {

        return $this->belongsTo(Sales::class, 'id_sales');

    }

    public function total_jam(){
       if ($this->jam_keluar != null && $this->jam_masuk != null) {
            $jam_masuk = strtotime($this->jam_masuk);
            $jam_keluar = strtotime($this->jam_keluar);
            $diff = $jam_keluar - $jam_masuk;
            $jam = floor($diff / (60 * 60));
            $menit = $diff - $jam * (60 * 60);
            $menit = floor($menit / 60);
            return $jam . ' jam ' . $menit . ' menit';
       }
         return 'Belum Check Out';
    }

  
}
