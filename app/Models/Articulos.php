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
        'titulo_articulo', 'palabras_clave_articulo','historia_articulo'
    ];
    // protected $guarded = [];
    // public function getRouteKeyName(){
    //     return 'url';
    // }
}
