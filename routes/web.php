<?php

use App\Http\Controllers\BancoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ComunaController;
use App\Http\Controllers\ComunidadesController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\AyudaSocialesController;
use App\Http\Controllers\ViviendasController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ManualController;


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/reset-password/{token}/{email}', function ($token, $email) {
    return view('reset-password-confirm', ['token' => $token, 'email' => $email]);
})->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'sendEmail'])->name('password.email');

Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.update');

/* Ruta Registro del Usuario */
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

/*creamos un grupo de rutas protegidas para los controlador de roles */

Route::resource('roles', RolController::class)->middleware('auth');
Route::resource('usuarios', UsuarioController::class)->middleware('auth');
Route::get('/verificar-cedula', [ UsuarioController::class,'verificarCedula'])->middleware('auth');

/* Ruta Login o Inicio de Sesión */
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);

/* Ruta Home o Vista Principal(Inicio) */
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

/* Ruta Logout o Cierre de Sesión */
Route::get('/logout', [logoutController::class, 'logout']);

/* Ruta Perfil Usuario */
Route::get('/Perfil',  [UserSettingsController::class,'Perfil'])->name('Perfil')->middleware('auth');
Route::post('/change/password',  [UserSettingsController::class,'changePassword'])->name('changePassword');

/* Ruta Comuna */
Route::get('/comuna',  [comunaController::class,'index'])->name('comuna')->middleware('auth');
Route::get('/comuna/create', [ComunaController::class, 'create'])->name('create')->middleware('auth');
Route::get('/comuna/pdf', [ComunaController::class,'pdf'])->name('comuna')->middleware('auth');
Route::resource('comuna', ComunaController::class)->middleware('auth');

/* Ruta Comunidad */
Route::get('/comunidad',  [ComunidadesController::class,'index'])->name('comunidad')->middleware('auth');
Route::get('/comunidad/create', [ComunidadesController::class, 'create'])->name('create')->middleware('auth');
Route::get('/comunidad/pdf',  [ComunidadesController::class,'pdf'])->name('comunidad')->middleware('auth');
Route::resource('comunidad', ComunidadesController::class)->middleware('auth');

/* Ruta Persona */
Route::get('/persona',  [PersonasController::class,'index'])->name('persona')->middleware('auth');
Route::get('/persona/create', [PersonasController::class, 'create'])->name('create')->middleware('auth');
Route::get('/persona/pdf',  [PersonasController::class,'pdf'])->name('persona')->middleware('auth');
Route::resource('persona', PersonasController::class)->middleware('auth');

/* Ruta Ayudas Sociales */
Route::get('/ayuda_sociales', [AyudaSocialesController::class, 'index'])->name('ayuda_sociales')->middleware('auth');
Route::get('/ayuda_sociales/create', [AyudaSocialesController::class, 'create'])->name('ayuda_sociales.create')->middleware('auth');
Route::get('/ayuda_sociales/pdf', [AyudaSocialesController::class, 'pdf'])->name('ayuda_sociales.pdf')->middleware('auth');
Route::resource('ayuda_sociales', AyudaSocialesController::class)->middleware('auth');

/* Ruta Viviendas */
Route::get('/vivienda', [ViviendasController::class, 'index'])->name('vivienda')->middleware('auth');
Route::get('/vivienda/create', [ViviendasController::class, 'create'])->name('vivienda.create')->middleware('auth');
Route::get('/vivienda/pdf', [ViviendasController::class, 'pdf'])->name('vivienda.pdf')->middleware('auth');
Route::resource('vivienda', ViviendasController::class)->middleware('auth');

/* Ruta Bitacora*/
Route::get('bitacora', [ReporteController::class, 'bitacora'])->name('bitacora')->middleware('auth');

/* Ruta Manual */
Route::get('/manual',  [ManualController::class,'index'])->name('manual')->middleware('auth');
