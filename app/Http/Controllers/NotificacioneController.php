<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use App\Models\Notificacione;
use App\Http\Controllers\Controller;

class NotificacioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function index($id)
    {
        $cafeNombre = Cafe::find($id);
        $notificaciones = Notificacione::all();
        return view('catalogos.notificaciones', compact('id','cafeNombre','notificaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'notificacion' => 'required',
            'fecha_hora' => 'required',
            'fecha_hora_inicio' => 'required',
            'fecha_hora_fin' => 'required',
            'activo' => 'required',
        ]);
        
        $datos = $request->except('_token');
        Notificacione::insert($datos);
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        Notificacione::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id)
    {
        Notificacione::destroy($id);
        return redirect()->back()->with('mensaje','Borrado Correctamente');
    }
}
