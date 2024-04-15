<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_local',
        'id_usuario',
        'estado',
    ];

    function cafes(){
        return $this->belongsTo(Cafe::class, 'id_local');
    }

    function usuarios(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
