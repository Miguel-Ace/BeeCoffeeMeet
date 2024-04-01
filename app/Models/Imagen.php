<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cafe',
        'imagen',
    ];

    function cafes(){
        return $this->belongsTo(Cafe::class, 'id_cafe');
    }
}
