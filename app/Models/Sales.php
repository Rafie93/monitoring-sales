<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales'; 
    protected $primaryKey = 'id_sales'; 
    protected $fillable = ['id_user', 'nama', 'no_telp', 'email', 'area_sales', 'target'];

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_sales');
    }

    public function pencapaian()
    {
        return $this->hasMany(Pencapaian::class, 'id_sales');
    }
}