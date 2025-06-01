<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil'; // Nama tabel
    protected $primaryKey = 'id_mobil'; // Kunci utama
    protected $fillable = ['id_tipe', 'sub_tipe', 'tahun', 'warna', 'jenis_transmisi', 'kapasitas_mesin', 'tempat_duduk', 'harga'];
    
    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'id_tipe');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_mobil');
    }

    public function pesananKendaraan()
    {
        return $this->hasMany(PesananKendaraan::class, 'id_mobil');
    }
}