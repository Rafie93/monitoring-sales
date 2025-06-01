<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harikerja extends Model
{
    use HasFactory;
    protected $table = "harikerja";
    protected $fillable = ["tahun","bulan","jumlah_kerja"];
}
