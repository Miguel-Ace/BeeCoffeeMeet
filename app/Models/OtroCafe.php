<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtroCafe extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_cafe',
        'otros_cafe',
    ];

    function cafes(){
        return $this->belongsTo(Cafe::class, 'id_cafe');
    }
}
