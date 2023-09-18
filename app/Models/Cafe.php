<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_usuario',
        'nombre',
        'descripcion_corta',
        'descripcion_larga',
        'url_logo',
        'eslogan',
        'cantidad_mesas',
        'capacidad',
        'provincia',
        'canton',
        'distrito',
        'barrio',
        'direccion',
        'longitud',
        'latitud',
        'promedio_valoracion',
    ];

    function usuarios(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
