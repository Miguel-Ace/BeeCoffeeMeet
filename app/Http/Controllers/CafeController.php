<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\User;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CafeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index()
    {
        // $response = Http::get('https://gist.githubusercontent.com/josuenoel/80daca657b71bc1cfd95a4e27d547abe/raw/5c615419196ed40a3dbdff69cb3d9719b1d6bb1e/provincias_cantones_distritos_costa_rica.json');
        // $datosCostaRica = $response->json();
        
        $cafes = Cafe::all();
        $reservaciones = Reserva::all();
        $users = User::all();
        $roles = Role::all();
        return view('cafes', compact('cafes','reservaciones','users','roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
            'url_logo' => 'required',
            'eslogan' => 'required',
            'cantidad_mesas' => 'required',
            'capacidad' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'distrito' => 'required',
            'barrio' => 'required',
            'direccion' => 'required',
            'max_time_reser' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
        ]);

        $imagenes = $request->file('url_logo');
        $nombreImagen = $imagenes->getClientOriginalName();
        
        $imagenes = $request->file('url_logo')->storeAS('public/imagenes', $nombreImagen);
        // $datos = $request->except('_token');
        Cafe::create([
            'id_usuario' => auth()->user()->id,
            'nombre' => $request['nombre'],
            'descripcion_corta' => $request['descripcion_corta'],
            'descripcion_larga' => $request['descripcion_larga'],
            'url_logo' => $nombreImagen,
            'eslogan' => $request['eslogan'],
            'cantidad_mesas' => $request['cantidad_mesas'],
            'capacidad' => $request['capacidad'],
            'provincia' => $request['provincia'],
            'canton' => $request['canton'],
            'distrito' => $request['distrito'],
            'barrio' => $request['barrio'],
            'direccion' => $request['direccion'],
            'max_time_reser' => $request['max_time_reser'],
            'latitud' => $request['latitud'],
            'longitud' => $request['longitud'], 
        ]);
        
        return redirect()->back()->with('mensaje','Creado Correctamente');
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion_corta' => 'required',
            'descripcion_larga' => 'required',
            // 'url_logo' => 'required',
            'eslogan' => 'required',
            'cantidad_mesas' => 'required',
            'capacidad' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'distrito' => 'required',
            'barrio' => 'required',
            'direccion' => 'required',
            'max_time_reser' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
        ]);
        
        $cafeAModificar = Cafe::find($id);
        if ($request['url_logo'] !== null) {
            
            // Ruta del archivo que deseas eliminar
            $archivo = 'public/imagenes/'.$cafeAModificar->url_logo;

            // Verificar si el archivo existe antes de intentar eliminarlo
            if (Storage::exists($archivo)) {
                // Eliminar el archivo
                Storage::delete($archivo);
            }

            // Guardando la imagen en el storage
            $imagenes = $request->file('url_logo');
            
            $nombreImagen = $imagenes->getClientOriginalName();
            
            $imagenes = $request->file('url_logo')->storeAS('public/imagenes', $nombreImagen);

            
            // // Actualizando la informacion en la bd
            $cafeAModificar->update([
                'nombre' => $request['nombre'],
                'descripcion_corta' => $request['descripcion_corta'],
                'descripcion_larga' => $request['descripcion_larga'],
                'url_logo' => $nombreImagen,
                'eslogan' => $request['eslogan'],
                'cantidad_mesas' => $request['cantidad_mesas'],
                'capacidad' => $request['capacidad'],
                'provincia' => $request['provincia'],
                'canton' => $request['canton'],
                'distrito' => $request['distrito'],
                'barrio' => $request['barrio'],
                'direccion' => $request['direccion'],
                'max_time_reser' => $request['max_time_reser'],
                'latitud' => $request['latitud'],
                'longitud' => $request['longitud'],
            ]);

            return redirect()->back()->with('mensaje','Actualizado Correctamente');
        }

        // // Actualizando la informacion en la bd
        $cafeAModificar->update([
            'nombre' => $request['nombre'],
            'descripcion_corta' => $request['descripcion_corta'],
            'descripcion_larga' => $request['descripcion_larga'],
            'url_logo' => $cafeAModificar->url_logo,
            'eslogan' => $request['eslogan'],
            'cantidad_mesas' => $request['cantidad_mesas'],
            'capacidad' => $request['capacidad'],
            'provincia' => $request['provincia'],
            'canton' => $request['canton'],
            'distrito' => $request['distrito'],
            'barrio' => $request['barrio'],
            'direccion' => $request['direccion'],
            'max_time_reser' => $request['max_time_reser'],
            'latitud' => $request['latitud'],
            'longitud' => $request['longitud'],
        ]);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }

    public function destroy($id)
    {
        Cafe::destroy($id);
        return redirect()->back()->with('mensaje','Eliminado Correctamente');
    }
}
