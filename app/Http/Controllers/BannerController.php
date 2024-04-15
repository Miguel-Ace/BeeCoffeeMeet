<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

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
        $tipos = ['Premium','Regular'];
        $acciones = ['Local','Reservación'];
        return view('catalogos.banner', compact('id','cafeNombre','otrosBanner','tipos','acciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url_imagen' => 'required|image',
            'fecha_hora' => 'required',
            'fecha_hora_inicio' => 'required',
            'fecha_hora_fin' => 'required',
            'tipo' => 'required',
            'acciones' => 'required',
            // 'activo' => 'required',
        ]);

        $imagenes = $request->file('url_imagen');
        $nombreImagen = $imagenes->getClientOriginalName();
        
        $imagenes = $request->file('url_imagen')->storeAS('public/banners', $nombreImagen);

        Banner::create([
            'id_cafe' => $request['id_cafe'],
            'url_imagen' => $nombreImagen,
            'fecha_hora' => $request['fecha_hora'],
            'fecha_hora_inicio' => $request['fecha_hora_inicio'],
            'fecha_hora_fin' => $request['fecha_hora_fin'],
            'activo' => 1,
            'tipo' => $request['tipo'],
            'acciones' => $request['acciones'],
        ]);
        // $datos = $request->except('_token');
        // Banner::insert($datos);
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'url_imagen' => 'required|image',
            'fecha_hora' => 'required',
            'fecha_hora_inicio' => 'required',
            'fecha_hora_fin' => 'required',
            'tipo' => 'required',
            'acciones' => 'required',
            // 'activo' => 'required',
        ]);

        $bannerAModificar = Banner::find($id);
        
        if ($request['url_imagen'] !== null) {
            
            // Ruta del archivo que deseas eliminar
            $archivo = 'public/banners/'.$bannerAModificar->url_imagen;

            // Verificar si el archivo existe antes de intentar eliminarlo
            if (Storage::exists($archivo)) {
                // Eliminar el archivo
                Storage::delete($archivo);
            }

            // Guardando la imagen en el storage
            $imagenes = $request->file('url_imagen');
            
            $nombreImagen = $imagenes->getClientOriginalName();
            
            $imagenes = $request->file('url_imagen')->storeAS('public/banners', $nombreImagen);

            
            // // Actualizando la informacion en la bd
            $bannerAModificar->update([
                // 'id_cafe' => $request['id_cafe'],
                'url_imagen' => $nombreImagen,
                'fecha_hora' => $request['fecha_hora'],
                'fecha_hora_inicio' => $request['fecha_hora_inicio'],
                'fecha_hora_fin' => $request['fecha_hora_fin'],
                'tipo' => $request['tipo'],
                'acciones' => $request['acciones'],
                // 'activo' => 1,
            ]);

            return redirect()->back()->with('mensaje','Actualizado Correctamente');
        }

        // Actualizando la informacion en la bd
        $bannerAModificar->update([
            // 'id_cafe' => $request['id_cafe'],
            'url_imagen' => $bannerAModificar->url_imagen,
            'fecha_hora' => $request['fecha_hora'],
            'fecha_hora_inicio' => $request['fecha_hora_inicio'],
            'fecha_hora_fin' => $request['fecha_hora_fin'],
            'tipo' => $request['tipo'],
            'acciones' => $request['acciones'],
            // 'activo' => 1,
        ]);

        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id, $imagen)
    {
        // Ruta del archivo que deseas eliminar
        $archivo = 'public/banners/'.$imagen;

        // Verificar si el archivo existe antes de intentar eliminarlo
        if (Storage::exists($archivo)) {
            // Eliminar el archivo
            Storage::delete($archivo);
        }

        Banner::destroy($id);
        return redirect()->back()->with('mensaje','Borrado Correctamente');
    }
}
