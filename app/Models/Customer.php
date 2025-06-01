<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer'; 
    protected $primaryKey = 'id_customer'; 
    protected $fillable = ['nama', 'jenis_identitas', 'no_identitas', 'no_npwp', 'alamat_ktp', 'alamat_domisili', 'email', 'no_hp', 'pekerjaan'];
    
    public function pesananKendaraan()
    {
        return $this->hasMany(PesananKendaraan::class, 'id_customer');
    }
}