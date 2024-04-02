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
        // $horarios = Horario::all();
        $horarios = Horario::where('id_cafe', $id)->orderBy('num_dia')->get();
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

        // $datos = $request->except('_token');
        Horario::create([
            'id_cafe' => $request['id_cafe'],
            'dia' => $request['dia'],
            'hora_inicio' => $request['hora_inicio'],
            'hora_fin' => $request['hora_fin'],
            'estado' => 1,
        ]);

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
        
        function data($request, $dia, $num_dia){
            return [
                'id_cafe' => $request['id_cafe'],
                'dia' => $dia,
                'hora_inicio' => $request['hora_inicio'],
                'hora_fin' => $request['hora_fin'],
                'estado' => 1,
                'num_dia' => $num_dia,
            ];
        }

        $dias = [["Lunes",1],["Martes",2],["Miércoles",3],["Jueves",4],["Viernes",5],["Sábado",6],["Domingo",7]];

        if ($request['dia'] === 'Generar días automaticamente') {
            // Crear todos los dias por defecto
            foreach ($dias as $i => $dia) {
                $isExistDia = Horario::where('id_cafe',$request['id_cafe'])
                    ->where('dia',$dia[0])
                    ->exists();

                if (!$isExistDia) {
                    Horario::create(data($request, $dia[0], $dia[1]));
                }
            }
        }else{
            // Crear un dia a la vez
            foreach ($dias as $i => $dia) {
                if ($dia[0] == $request['dia']) {
                    Horario::create(data($request, $dia[0], $dia[1]));
                    break;
                }
            }
        }

        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        Horario::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function update_activo($id)
    {
        $dia = Horario::where('id',$id);
        $diaEstado = $dia->value('estado');
        $estado = $diaEstado ? 0 : 1;

        $dia->update([
            'estado' => $estado
        ]);

        return redirect()->back()->with('mensaje','Estado Actualizado');
    }

    public function destroy($id)
    {
        Horario::destroy($id);
        return redirect()->back()->with('mensaje','Borrado Correctamente');
    }
}
