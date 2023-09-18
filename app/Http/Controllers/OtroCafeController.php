<?php

namespace App\Http\Controllers;

use App\Models\OtroCafe;
use App\Http\Controllers\Controller;
use App\Models\Cafe;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class OtroCafeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index($id)
    {
        $cafeNombre = Cafe::find($id);
        $otrosCafes = OtroCafe::all();
        return view('catalogos.otros_cafes', compact('id','cafeNombre','otrosCafes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'otros_cafe' => 'required'
        ]);

        $datos = $request->except('_token');
        OtroCafe::insert($datos);
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        OtroCafe::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id)
    {
        OtroCafe::destroy($id);
        return redirect()->back()->with('mensaje','Borrado Correctamente');
    }
}
