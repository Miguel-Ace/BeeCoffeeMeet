<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function index($id)
    {
        $cafeNombre = Cafe::find($id);
        $otrosBanner = Banner::all();
        return view('catalogos.banner', compact('id','cafeNombre','otrosBanner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url_imagen' => 'required',
            'fecha_hora' => 'required',
            'fecha_hora_inicio' => 'required',
            'fecha_hora_fin' => 'required',
            'activo' => 'required',
        ]);

        $datos = $request->except('_token');
        Banner::insert($datos);
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        Banner::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id)
    {
        Banner::destroy($id);
        return redirect()->back()->with('mensaje','Borrado Correctamente');
    }
}
