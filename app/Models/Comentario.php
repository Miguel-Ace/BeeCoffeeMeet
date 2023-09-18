<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_cafe',
        'id_usuario',
        'comentario',
        'fecha_hora',
        'estrellas',
    ];

    function cafes(){
        return $this->belongsTo(Cafe::class, 'id_cafe');
    }

    function usuarios(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
