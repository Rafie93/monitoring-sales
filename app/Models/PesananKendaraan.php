<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananKendaraan extends Model
{
    use HasFactory;

    protected $table = 'pesanan_kendaraan'; 
    protected $primaryKey = 'id_pesanan'; 
    protected $fillable = ['no_spk', 'id_customer', 'id_mobil', 'warna',
    'tipe_plat', 'stnk_alamat', 'harga', 'tanggal_pesanan','id_sales',
     'jumlah_unit', 'diskon', 'total', 'status_pesanan', 'status_pembayaran'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
    public function sales()
    {
        return $this->belongsTo(Sales::class, 'id_sales');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_pesanan');
    }


    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil');
    }
}