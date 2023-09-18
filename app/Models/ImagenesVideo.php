<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesVideo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_cafe',
        'url_imagen_video',
    ];

    function cafes(){
        return $this->belongsTo(Cafe::class, 'id_cafe');
    }
}
