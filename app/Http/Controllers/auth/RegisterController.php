<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\notificar_admin;
use App\Mail\notificar_user;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request->get('name'));

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'direccion' => 'nullable',
            'telefono' => 'required|numeric|min:8',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'password' => $request->password,
            'activo' => 0,
            'movil' => 0,
        ]);

        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        // auth()->attempt($request->only('email','password'));

        $vista_admin = new notificar_admin($request->all());
        Mail::to('acevedo51198mac@gmail.com')->send($vista_admin);

        $vista_user = new notificar_user($request->input('name'));
        $correo = $request->input('email');
        Mail::to($correo)->send($vista_user);

        // return redirect('/');
        return redirect()->back()->with('mensaje', 'Regístrado con éxito, favor esperar a que validen su cuenta');
    }
}
