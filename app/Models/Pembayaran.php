<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; 
    protected $primaryKey = 'id_pembayaran'; 
    protected $fillable = ['id_pesanan', 'metode_bayar', 'jumlah_bayar', 'keterangan_bayar', 'bukti_bayar'];

    public function pesananKendaraan()
    {
        return $this->belongsTo(PesananKendaraan::class, 'id_pesanan');
    }
}