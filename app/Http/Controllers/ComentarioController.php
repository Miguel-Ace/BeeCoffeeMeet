<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\notificar_cambio_comentario;
use App\Models\User;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }
    
    public function index($id)
    {
        $cafeNombre = Cafe::find($id);
        $comentarios = Comentario::all();
        return view('catalogos.comentarios', compact('id','cafeNombre','comentarios'));
    }

    public function update(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        Comentario::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Correctamente');
    }
    
    public function send_email_cambio_comentario(Request $request, $id_comentario, $id_usuario)
    {
        $comentario = Comentario::find($id_comentario);
        $cafe = Cafe::find($id_comentario)->nombre;
        $usuario = User::find($id_usuario);
        function mensaje($cafe, $usuario, $mensaje){
            return [
                'nombre_cafe' => $cafe,
                'nombre_usuario' => $usuario->name,
                'mensaje' => $mensaje
            ];
        }

        $mensaje_admin = 'El usuario '.$usuario->name.', dueño del café: '.$cafe.' quiere desactivar el comentario '.$comentario->comentario.' cuyo id es '.$comentario->id;
        $mensaje_usuario = 'Estimado '.$usuario->name.', favor espere a que el administrador apruebe desactivar el comentario: '.$comentario->comentario;

        $vista = new notificar_cambio_comentario(mensaje($cafe, $usuario, $mensaje_admin));
        // Mail::to('acevedo51198mac@gmail.com')->send($vista);
        Mail::to('ramses.rivas@gmail.com')->send($vista);
        $vista = new notificar_cambio_comentario(mensaje($cafe, $usuario, $mensaje_usuario));
        Mail::to($usuario->email)->send($vista);

        return redirect()->back()->with('mensaje','Enviado Correctamente');
    }
}
