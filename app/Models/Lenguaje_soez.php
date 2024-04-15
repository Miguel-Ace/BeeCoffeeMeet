<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lenguaje_soez extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_usuario',
        'palabras',
    ];

    function usuarios(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
