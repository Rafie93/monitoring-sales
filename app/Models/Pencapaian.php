<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencapaian extends Model
{
    use HasFactory;

    protected $table = 'pencapaian'; 
    protected $primaryKey = 'id_pencapaian'; 
    protected $fillable = ['id_sales', 'bulan', 'tahun', 'target_penjualan','penjualan',
    'hasil_penjualan','kehadiran','hasil_kehadiran','hasil_pencapaian','rangking'];

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'id_sales');
    }
}