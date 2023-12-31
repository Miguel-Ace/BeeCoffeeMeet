<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function index($id)
    {
        $cafeNombre = Cafe::find($id);
        $comentarios = Comentario::all();
        return view('catalogos.comentarios', compact('id','cafeNombre','comentarios'));
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        Comentario::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }
}
