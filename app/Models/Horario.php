<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_cafe',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];

    function cafes(){
        return $this->belongsTo(Cafe::class, 'id_cafe');
    }
}
