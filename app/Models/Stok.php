<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok'; 
    protected $primaryKey = 'id_stok'; 
    protected $fillable = ['id_mobil', 'jumlah'];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil');
    }
}