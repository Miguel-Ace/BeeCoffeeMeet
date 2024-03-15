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
        $dias = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo","Generar días automaticamente"];
        return view('catalogos.horarios', compact('id','cafeNombre','horarios','dias'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ],[
            'hora_inicio.required' => 'Digite la hora de inicio',
            'hora_fin.required' => 'Digite la hora que finaliza',
        ]);

        $datos = $request->except('_token');
        Horario::insert($datos);
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function store_masivo(Request $request)
    {
        $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ],[
            'hora_inicio.required' => 'Digite la hora de inicio',
            'hora_fin.required' => 'Digite la hora que finaliza',
        ]);

        // $exist_horario_for_user = Horario::where('id_cafe',$id)->get();
        
        if ($request['dia'] === 'Generar días automaticamente') {
            // Crear todos los dias por defecto
            $dias = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];
            foreach ($dias as $i => $dia) {
                Horario::create([
                    'id_cafe' => $request['id_cafe'],
                    'dia' => $dia,
                    'hora_inicio' => $request['hora_inicio'],
                    'hora_fin' => $request['hora_fin'],
                ]);
            }
        }else{
            // Crear un dia a la vez
            $datos = $request->except('_token');
            Horario::insert($datos);
        }

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
