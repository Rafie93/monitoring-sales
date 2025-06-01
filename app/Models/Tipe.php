<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    use HasFactory;
    protected $table = "Tipe";
    protected $primaryKey ="id_tipe";
    protected $fillable = [
        'tipe',
    ];

    public function mobil()

    {

        return $this->hasMany(Mobil::class, 'id_tipe');

    }
}
