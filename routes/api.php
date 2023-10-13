<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[ApiController::class, 'register']);
Route::post('/login',[ApiController::class, 'login']);

Route::post('/userPorJson',[ApiController::class, 'userPorJson']);

// ================ Usuarios =====================
Route::get('/user', [ApiController::class, 'getUser'])->middleware('auth:sanctum');
Route::get('/user/{id}', [ApiController::class, 'getUserid'])->middleware('auth:sanctum');
Route::post('/user/insert', [ApiController::class, 'insertUser'])->middleware('auth:sanctum');
Route::put('/user/update/{id}', [ApiController::class, 'updateUser'])->middleware('auth:sanctum');
Route::delete('/user/delete/{id}', [ApiController::class, 'deleteUser'])->middleware('auth:sanctum');

// ================ Cafés =====================
Route::get('/cafe', [ApiController::class, 'getCafe'])->middleware('auth:sanctum');
Route::get('/cafe_x_usuario/{id_usuario}', [ApiController::class, 'getCafePorUsuario'])->middleware('auth:sanctum');
Route::get('/cafe/{id}', [ApiController::class, 'getCafeid'])->middleware('auth:sanctum');
Route::post('/cafe/insert', [ApiController::class, 'insertCafe'])->middleware('auth:sanctum');
Route::put('/cafe/update/{id}', [ApiController::class, 'updateCafe'])->middleware('auth:sanctum');
Route::delete('/cafe/delete/{id}', [ApiController::class, 'deleteCafe'])->middleware('auth:sanctum');

// ================ Banner =====================
Route::get('/banner', [ApiController::class, 'getBanner'])->middleware('auth:sanctum');
Route::get('/banner_x_cafe/{id_cafe}', [ApiController::class, 'getBannerPorCafe'])->middleware('auth:sanctum');
Route::get('/banner/{id}', [ApiController::class, 'getBannerid'])->middleware('auth:sanctum');
Route::post('/banner/insert', [ApiController::class, 'insertBanner'])->middleware('auth:sanctum');
Route::put('/banner/update/{id}', [ApiController::class, 'updateBanner'])->middleware('auth:sanctum');
Route::delete('/banner/delete/{id}', [ApiController::class, 'deleteBanner'])->middleware('auth:sanctum');

// ================ Comentarios =====================
Route::get('/comentarios', [ApiController::class, 'getComentarios'])->middleware('auth:sanctum');
Route::get('/comentarios_x_cafe/{id_cafe}', [ApiController::class, 'getComentariosPorCafe'])->middleware('auth:sanctum');
Route::get('/comentarios_x_usuario/{id_usuario}', [ApiController::class, 'getComentariosPorUsuario'])->middleware('auth:sanctum');
Route::get('/comentarios/{id}', [ApiController::class, 'getComentariosid'])->middleware('auth:sanctum');
Route::post('/comentarios/insert', [ApiController::class, 'insertComentarios'])->middleware('auth:sanctum');
Route::put('/comentarios/update/{id}', [ApiController::class, 'updateComentarios'])->middleware('auth:sanctum');
Route::delete('/comentarios/delete/{id}', [ApiController::class, 'deleteComentarios'])->middleware('auth:sanctum');

// ================ Imagen/video =====================
Route::get('/imagen_video', [ApiController::class, 'getImagenesVideo'])->middleware('auth:sanctum');
Route::get('/imagen_video_x_cafe/{id_cafe}', [ApiController::class, 'getImagenesVideoPorCafe'])->middleware('auth:sanctum');
Route::get('/imagen_video/{id}', [ApiController::class, 'getImagenesVideoid'])->middleware('auth:sanctum');
Route::post('/imagen_video/insert', [ApiController::class, 'insertImagenesVideo'])->middleware('auth:sanctum');
Route::put('/imagen_video/update/{id}', [ApiController::class, 'updateImagenesVideo'])->middleware('auth:sanctum');
Route::delete('/imagen_video/delete/{id}', [ApiController::class, 'deleteImagenesVideo'])->middleware('auth:sanctum');

// ================ Notificaciones =====================
Route::get('/notificacion', [ApiController::class, 'getNotificacion'])->middleware('auth:sanctum');
Route::get('/notificacion_x_cafe/{id_cafe}', [ApiController::class, 'getNotificacionPorCafe'])->middleware('auth:sanctum');
Route::get('/notificacion/{id}', [ApiController::class, 'getNotificacionid'])->middleware('auth:sanctum');
Route::post('/notificacion/insert', [ApiController::class, 'insertNotificacion'])->middleware('auth:sanctum');
Route::put('/notificacion/update/{id}', [ApiController::class, 'updateNotificacion'])->middleware('auth:sanctum');
Route::delete('/notificacion/delete/{id}', [ApiController::class, 'deleteNotificacion'])->middleware('auth:sanctum');

// ================ Otro café =====================
Route::get('/otro_cafe', [ApiController::class, 'getOtroCafe'])->middleware('auth:sanctum');
Route::get('/otro_cafe_x_cafe/{id_cafe}', [ApiController::class, 'getOtroCafePorCafe'])->middleware('auth:sanctum');
Route::get('/otro_cafe/{id}', [ApiController::class, 'getOtroCafeid'])->middleware('auth:sanctum');
Route::post('/otro_cafe/insert', [ApiController::class, 'insertOtroCafe'])->middleware('auth:sanctum');
Route::put('/otro_cafe/update/{id}', [ApiController::class, 'updateOtroCafe'])->middleware('auth:sanctum');
Route::delete('/otro_cafe/delete/{id}', [ApiController::class, 'deleteOtroCafe'])->middleware('auth:sanctum');

// ================ Reservaciones =====================
Route::get('/reservaciones', [ApiController::class, 'getReservaciones'])->middleware('auth:sanctum');
Route::get('/reservaciones_x_cafe/{id_cafe}', [ApiController::class, 'getReservacionesPorCafe'])->middleware('auth:sanctum');
Route::get('/reservaciones/{id}', [ApiController::class, 'getReservacionesid'])->middleware('auth:sanctum');
Route::post('/reservaciones/insert', [ApiController::class, 'insertReservaciones'])->middleware('auth:sanctum');
Route::put('/reservaciones/update/{id}', [ApiController::class, 'updateReservaciones'])->middleware('auth:sanctum');
Route::delete('/reservaciones/delete/{id}', [ApiController::class, 'deleteReservaciones'])->middleware('auth:sanctum');

// ================ Horarios =====================
Route::get('/horarios', [ApiController::class, 'getHorarios'])->middleware('auth:sanctum');
Route::get('/horarios_x_cafe/{id_cafe}', [ApiController::class, 'getHorariosPorCafe'])->middleware('auth:sanctum');
Route::get('/horarios/{id}', [ApiController::class, 'getHorariosid'])->middleware('auth:sanctum');
Route::post('/horarios/insert', [ApiController::class, 'insertHorarios'])->middleware('auth:sanctum');
Route::put('/horarios/update/{id}', [ApiController::class, 'updateHorarios'])->middleware('auth:sanctum');
Route::delete('/horarios/delete/{id}', [ApiController::class, 'deleteHorarios'])->middleware('auth:sanctum');