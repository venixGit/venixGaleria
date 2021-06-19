<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "blog";
    protected $primaryKey = "id_blog";
    protected $fillable = [
        'dominio_blog',
        'titulo_blog',
        'palabras_clave_blog',
        'logo_blog',
        'icono_blog',
        'fecha'
    ];

    // public function usuarios(){
    //     return $this->hasMany('App\Models\User', 'id_usuario', 'usuarios');
    // }
}
