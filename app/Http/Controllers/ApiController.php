<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cafe;
use App\Models\Comentario;
use App\Models\Horario;
use App\Models\ImagenesVideo;
use App\Models\Notificacione;
use App\Models\OtroCafe;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\send_email;
use App\Models\Imagen;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    // ================ Regístro =====================
    // ================================================
    
    public function register(Request $request){
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'direccion' => 'nullable',
            'activo' => 'nullable',
            'movil' => 'nullable',
            'telefono' => 'required|numeric|digits:8',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'direccion' => $validateData['direccion'],
            'activo' => $validateData['activo'],
            'movil' => $validateData['movil'],
            'telefono' => $validateData['telefono'],
            'password' =>  Hash::make($validateData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
    
    // ================ Login =====================
    // ================================================
    
    public function login(Request $request){
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json(['Mensaje' => 'Inicio Invalido'],404);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        // if ($request->email == "acevedo51198mac@gmail.com") {
        if ($request->email == "ramses.rivas@gmail.com") {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        }else{
            return response()->json([
                'Status' => 200,
                'Mensaje' => 'OK',
            ], 200);
        }
    }

    // ================ Enviar email y password por json para retornar usuario =====================
    // =============================================================================================
    
    public function userPorJson(Request $request){
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json(['Mensaje' => 'Inicio Invalido'],404);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        return response()->json($user,200);
    }

    // ================ Usuarios =====================
    // ================================================
    
    public function getUser(){
        return response()->json(User::all(),200);
    }

    public function getUserid($id){
        $usuario = User::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertUser(Request $request){
        $usuario = User::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateUser(Request $request, $id){
        $usuario = User::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteUser($id){
        $usuario = User::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ================ Cafés =====================
    // ============================================
    
    public function getCafe(){
        return response()->json(Cafe::all()->load('usuarios'),200);
    }

    public function getCafePorUsuario($usuario) {
        $categoria_producto = Cafe::where('id_usuario', $usuario)->get()->load('usuarios');

        return response()->json($categoria_producto, 200);
    }

    public function getCafeid($id){
        $usuario = Cafe::find($id)->load('usuarios');
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertCafe(Request $request){
        $usuario = Cafe::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateCafe(Request $request, $id){
        $usuario = Cafe::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteCafe($id){
        $usuario = Cafe::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ================ Banner =====================
    // =============================================
    
    public function getBanner(){
        return response()->json(Banner::all()->load('cafes'),200);
    }

    public function getBannerPorCafe($cafe) {
        $categoria_producto = Banner::where('id_cafe', $cafe)->get()->load('cafes');

        return response()->json($categoria_producto, 200);
    }

    public function getBannerid($id){
        $usuario = Banner::find($id)->load('cafes');
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertBanner(Request $request){
        $usuario = Banner::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateBanner(Request $request, $id){
        $usuario = Banner::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteBanner($id){
        $usuario = Banner::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ================ Comentario ====================
    // ================================================
    
    public function getComentarios(){
        return response()->json(Comentario::all()->load('cafes','usuarios'),200);
    }

    public function getComentariosPorCafe($cafe) {
        $categoria_producto = Comentario::where('id_cafe', $cafe)->get()->load('cafes','usuarios');

        return response()->json($categoria_producto, 200);
    }

    public function getComentariosPorUsuario($usuario) {
        $categoria_producto = Comentario::where('id_usuario', $usuario)->get()->load('cafes','usuarios');

        return response()->json($categoria_producto, 200);
    }

    public function getComentariosid($id){
        $usuario = Comentario::find($id)->load('cafes','usuarios');
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertComentarios(Request $request){
        $usuario = Comentario::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateComentarios(Request $request, $id){
        $usuario = Comentario::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteComentarios($id){
        $usuario = Comentario::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }
    
    // ================ Imagen/Video =====================
    // =============================================
    
    public function getImagenesVideo(){
        return response()->json(ImagenesVideo::all()->load('cafes'),200);
    }

    public function getImagenesVideoPorCafe($cafe) {
        $categoria_producto = ImagenesVideo::where('id_cafe', $cafe)->get()->load('cafes');

        return response()->json($categoria_producto, 200);
    }

    public function getImagenesVideoid($id){
        $usuario = ImagenesVideo::find($id)->load('cafes');
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertImagenesVideo(Request $request){
        $usuario = ImagenesVideo::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateImagenesVideo(Request $request, $id){
        $usuario = ImagenesVideo::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteImagenesVideo($id){
        $usuario = ImagenesVideo::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ================ Notificaciones =====================
    // =============================================
    
    public function getNotificacion(){
        return response()->json(Notificacione::all()->load('cafes'),200);
    }

    public function getNotificacionPorCafe($cafe) {
        $categoria_producto = Notificacione::where('id_cafe', $cafe)->get()->load('cafes');

        return response()->json($categoria_producto, 200);
    }

    public function getNotificacionid($id){
        $usuario = Notificacione::find($id)->load('cafes');
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertNotificacion(Request $request){
        $usuario = Notificacione::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateNotificacion(Request $request, $id){
        $usuario = Notificacione::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteNotificacion($id){
        $usuario = Notificacione::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ================ Otro Cafe =====================
    // ================================================
    
    public function getOtroCafe(){
        return response()->json(OtroCafe::all()->load('cafes'),200);
    }

    public function getOtroCafePorCafe($cafe) {
        $categoria_producto = OtroCafe::where('id_cafe', $cafe)->get()->load('cafes');

        return response()->json($categoria_producto, 200);
    }

    public function getOtroCafeid($id){
        $usuario = OtroCafe::find($id)->load('cafes');
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertOtroCafe(Request $request){
        $usuario = OtroCafe::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateOtroCafe(Request $request, $id){
        $usuario = OtroCafe::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteOtroCafe($id){
        $usuario = OtroCafe::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }
    
    // ================ Reservaciones =================
    // ================================================
    
    public function getReservaciones(){
        return response()->json(Reserva::all()->load('cafes'),200);
    }

    public function getReservacionesPorCafe($cafe) {
        $categoria_producto = Reserva::where('id_cafe', $cafe)->get()->load('cafes');

        return response()->json($categoria_producto, 200);
    }

    public function getReservacionesPorUser($user) {
        $categoria_producto = Reserva::where('id_usuario', $user)->get()->load('cafes');

        return response()->json($categoria_producto, 200);
    }

    public function getReservacionesid($id){
        $usuario = Reserva::find($id)->load('cafes');
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertReservaciones(Request $request){
        $usuario = Reserva::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateReservaciones(Request $request, $id){
        $usuario = Reserva::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteReservaciones($id){
        $usuario = Reserva::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ================ Horarios =================
    // ===========================================
    
    public function getHorarios(){
        return response()->json(Horario::all()->load('cafes'),200);
    }

    public function getHorariosPorCafe($cafe) {
        $categoria_producto = Horario::where('id_cafe', $cafe)->get()->load('cafes');

        return response()->json($categoria_producto, 200);
    }

    public function getHorariosid($id){
        $usuario = Horario::find($id)->load('cafes');
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertHorarios(Request $request){
        $usuario = Horario::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateHorarios(Request $request, $id){
        $usuario = Horario::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteHorarios($id){
        $usuario = Horario::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }
    
    // ================ Imagenes ===================
    // =============================================
    
    public function getImagenes(){
        return response()->json(Imagen::all()->load('cafes'),200);
    }

    public function getImagenesPorCafe($cafe) {
        $imagen = Imagen::where('id_cafe', $cafe)->get()->load('cafes');

        return response()->json($imagen, 200);
    }

    public function getImagenesid($id){
        $imagen = Imagen::find($id)->load('cafes');
        if (is_null($imagen)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($imagen,200);
    }

    public function insertImagenes(Request $request){
        $imagen = Imagen::create($request->all());
        if (is_null($imagen)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($imagen,200);
    }

    public function updateImagenes(Request $request, $id){
        $imagen = Imagen::find($id);
        if (is_null($imagen)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $imagen->update($request->all());
        return response()->json($imagen,200);
    }

    public function deleteImagenes($id){
        $imagen = Imagen::find($id);
        if (is_null($imagen)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $imagen->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ================ Send Email =================
    // ===========================================
    public function send_email(Request $request, $correo){
        $vista = new send_email($request->all());
        Mail::to($correo)->send($vista);
    }
}
