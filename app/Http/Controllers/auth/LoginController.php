<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        // dd($request->get('password'));

        $usuario = User::where('email', $request->input('email'))->first();
        
        if ($usuario) {
            if ($usuario->activo != null or $usuario->activo != 0) {
                $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);
                
                if (!auth()->attempt($request->only('email','password'), $request->remember)) {
                    return back()->with('mensaje','Credenciales Incorrectas');
                }
                
                return redirect('/');
            }else{
                // dd('No está activo el usuario' . $usuario->activo);
                return redirect()->back()->with('mensaje', 'Este usuario no tiene permisos para entrar');
            }
        }else{
            // dd('No hay usuario');
            return redirect()->back()->with('mensaje', 'No existe ese usuario');
        }

    }
}
