<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_cafe',
        'id_usuario',
        'fecha_hora',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'cantidad_personas',
        'peticion',
        'comentarios',
        'activo',
    ];

    function cafes(){
        return $this->belongsTo(Cafe::class, 'id_cafe');
    }

    function usuarios(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
