<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HorarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        $cafeNombre = Cafe::find($id);
        $horarios = Horario::all();
        return view('catalogos.horarios', compact('id','cafeNombre','horarios'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        $datos = $request->except('_token');
        Horario::insert($datos);
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        Horario::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id)
    {
        Horario::destroy($id);
        return redirect()->back()->with('mensaje','Borrado Correctamente');
    }
}
