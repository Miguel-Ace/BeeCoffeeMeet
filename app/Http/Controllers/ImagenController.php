<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Imagen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        $cafeNombre = Cafe::find($id);
        $imagenes = Imagen::all();
        return view('catalogos.imagenes', compact('id','cafeNombre','imagenes'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image',
        ],[
            'imagen.required' => 'Es necesario una imagen',
            'imagen.image' => 'Es necesario que el archivo sea una imagen',
        ]);

        $imagenes = $request->file('imagen');
        $nombreImagen = $imagenes->getClientOriginalName();
        
        $imagenes = $request->file('imagen')->storeAS('public/imagenes', $nombreImagen);

        Imagen::create([
            'id_cafe' => $request['id_cafe'],
            'imagen' => $nombreImagen
        ]);

        return redirect()->back();
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


        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request, $id)
    {
        // $datos = $request->except('_token','_method');
        // Horario::where('id','=',$id)->update($datos);
        // return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id, $imagen)
    {
        // Ruta del archivo que deseas eliminar
        $archivo = 'public/imagenes/'.$imagen;

        // Verificar si el archivo existe antes de intentar eliminarlo
        if (Storage::exists($archivo)) {
            // Eliminar el archivo
            Storage::delete($archivo);
        }

        Imagen::destroy($id);
        return redirect()->back()->with('mensaje','Borrado Correctamente');
    }
}
