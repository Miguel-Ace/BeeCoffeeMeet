<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Support\Facades\Http;

class CafeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index()
    {
        $response = Http::get('https://gist.githubusercontent.com/josuenoel/80daca657b71bc1cfd95a4e27d547abe/raw/5c615419196ed40a3dbdff69cb3d9719b1d6bb1e/provincias_cantones_distritos_costa_rica.json');
        $datosCostaRica = $response->json();
        
        $cafes = Cafe::all();
        $reservaciones = Reserva::all();
        return view('cafes', compact('datosCostaRica','cafes','reservaciones'));
    }

    public function store(Request $request)
    {
        $datos = $request->except('_token');
        Cafe::insert($datos);
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request,$id)
    {
        // dd('Probando');
        $datos = $request->except('_token','_method');
        Cafe::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id)
    {
        Cafe::destroy($id);
        return redirect()->back()->with('mensaje','Eliminado Correctamente');
    }
}
