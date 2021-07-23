<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    use HasFactory;
    protected $table = "articulos";
    protected $primaryKey = "id_articulo";

    protected $fillable = [
        'titulo_articulo', 'palabras_clave_articulo','historia_articulo', 'img_articulo'
    ];
    protected $guarded = [];
    
    //uso del scope
    // public function scopePalabra($query, $palabra)
    // {
    //     if($palabra)
    //         return $query->where('palabras_clave_articulo', 'LIKE', "%$palabra%");
    // }
}
