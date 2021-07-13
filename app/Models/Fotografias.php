<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotografias extends Model
{
    use HasFactory;
    protected $table = "fotografias";
    protected $primaryKey = "id_foto";

    protected $fillable = [
        'titulo_foto', 'historia_foto', 'img_foto'
    ];
    protected $guarded = [];

    public function palabrasClaves(){
        return $this->hasMany(Palabras::class, 'id_foto');
    }
}
