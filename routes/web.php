<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\OtroCafeController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\ImagenesVideoController;
use App\Http\Controllers\NotificacioneController;
use App\Http\Controllers\vista\PrincipalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LogoutController::class,'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Cafés
Route::get('/',[CafeController::class, 'index']);
Route::post('/cafe', [CafeController::class, 'store'])->name('cafe.store');
Route::patch('/cafe/{id}', [CafeController::class, 'update']);
Route::delete('/cafe/{id}', [CafeController::class, 'destroy']);

// Otros cafés
Route::get('/panel/otros_cafes/{id}',[OtroCafeController::class, 'index']);
Route::post('/panel/otros_cafe', [OtroCafeController::class, 'store'])->name('otros_cafes.store');
Route::patch('/panel/otros_cafes/{id}', [OtroCafeController::class, 'update']);
Route::delete('/panel/otros_cafes/{id}', [OtroCafeController::class, 'destroy'])->name('otros_cafes.destroy');

// Notificaciones
Route::get('/panel/notificaciones/{id}',[NotificacioneController::class, 'index']);
Route::post('/panel/notificaciones', [NotificacioneController::class, 'store'])->name('notificaciones.store');
Route::patch('/panel/notificaciones/{id}', [NotificacioneController::class, 'update']);
Route::delete('/panel/notificaciones/{id}', [NotificacioneController::class, 'destroy'])->name('notificaciones.destroy');

// Banner
Route::get('/panel/banner/{id}',[BannerController::class, 'index']);
Route::post('/panel/banner', [BannerController::class, 'store'])->name('banner.store');
Route::patch('/panel/banner/{id}', [BannerController::class, 'update']);
Route::delete('/panel/banner/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');

// Multimedias
Route::get('/panel/multimedias/{id}',[ImagenesVideoController::class, 'index']);
Route::post('/panel/multimedias', [ImagenesVideoController::class, 'store'])->name('multimedias.store');
Route::patch('/panel/multimedias/{id}', [ImagenesVideoController::class, 'update']);
Route::delete('/panel/multimedias/{id}', [ImagenesVideoController::class, 'destroy'])->name('multimedias.destroy');

// Comentarios
Route::get('/panel/comentarios/{id}',[ComentarioController::class, 'index']);
Route::patch('/panel/comentarios/{id}', [ComentarioController::class, 'update']);

// Horarios
Route::get('/panel/horarios/{id}',[HorarioController::class, 'index']);
Route::post('/panel/horarios', [HorarioController::class, 'store'])->name('horarios.store');
Route::patch('/panel/horarios/{id}', [HorarioController::class, 'update']);
Route::delete('/panel/horarios/{id}', [HorarioController::class, 'destroy'])->name('horarios.destroy');

// Roles
Route::put('/assign/{id}', [RolController::class, 'update'])->name('role.update');
Route::delete('/assign/{id}', [RolController::class, 'destroy'])->name('role.destroy');