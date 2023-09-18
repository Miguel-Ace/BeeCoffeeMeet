<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use App\Models\ImagenesVideo;
use App\Http\Controllers\Controller;

class ImagenesVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function index($id)
    {
        $cafeNombre = Cafe::find($id);
        $otrosImagenesVideo = ImagenesVideo::all();
        return view('catalogos.imagenes_video', compact('id','cafeNombre','otrosImagenesVideo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url_imagen_video' => 'required'
        ]);

        $datos = $request->except('_token');
        ImagenesVideo::insert($datos);
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        ImagenesVideo::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id)
    {
        ImagenesVideo::destroy($id);
        return redirect()->back()->with('mensaje','Borrado Correctamente');
    }
}
