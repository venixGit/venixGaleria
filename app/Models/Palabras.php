<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palabras extends Model
{
    use HasFactory;
    protected $table = "palabras_claves";
    protected $primaryKey = "id_palabra";

    protected $fillable = [
        "id_foto", "nombre"
    ];

    
}
