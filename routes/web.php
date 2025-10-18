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
use App\Http\Controllers\ConsejoComunalController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\VocerosController;
use App\Http\Controllers\AyudasController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\ResposanblesController;
use App\Http\Controllers\VisitasController;
use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\ControlSeguimientosController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\EstadisticaController;


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
Route::get('/vocero', [HomeController::class, 'showVoceros'])->name('vocero.index');

/* Ruta Logout o Cierre de Sesión */
Route::get('/logout', [logoutController::class, 'logout']);

/* Ruta Perfil Usuario */
Route::get('/Perfil',  [UserSettingsController::class,'Perfil'])->name('Perfil')->middleware('auth');
Route::post('/change/password',  [UserSettingsController::class,'changePassword'])->name('changePassword');

/* Ruta Cargo */
Route::get('/cargo',  [CargosController::class,'index'])->name('cargo')->middleware('auth');
Route::get('/cargo/create', [CargosController::class, 'create'])->name('create')->middleware('auth');
Route::get('/cargo/pdf', [CargosController::class,'pdf'])->name('cargo')->middleware('auth');
Route::resource('cargo', CargosController::class)->middleware('auth');

/* Ruta Vocero */
Route::get('/vocero',  [VocerosController::class,'index'])->name('vocero')->middleware('auth');
Route::get('/vocero/create', [VocerosController::class, 'create'])->name('create')->middleware('auth');
Route::get('/vocero/pdf',  [VocerosController::class,'pdf'])->name('vocero')->middleware('auth');
Route::resource('vocero', VocerosController::class)->middleware('auth');
Route::get('/vocero/detalles/{id}', [VocerosController::class, 'getVoceroDetalles']);

/* Ruta Comunidad */
Route::get('/comunidad',  [ComunidadesController::class,'index'])->name('comunidad')->middleware('auth');
Route::get('/comunidad/create', [ComunidadesController::class, 'create'])->name('create')->middleware('auth');
Route::get('/comunidad/pdf',  [ComunidadesController::class,'pdf'])->name('comunidad')->middleware('auth');
Route::resource('comunidad', ComunidadesController::class)->middleware('auth');
Route::get('/comunidad/detalles/{id}', [ComunidadesController::class, 'getComunidadDetalles']);

/* Ruta Consejo Comunal */
Route::get('/consejo_comunal',  [ConsejoComunalController::class,'index'])->name('consejo_comunal')->middleware('auth');
Route::get('/consejo_comunal/create', [ConsejoComunalController::class, 'create'])->name('create')->middleware('auth');
Route::get('/consejo_comunal/pdf',  [ConsejoComunalController::class,'pdf'])->name('consejo_comunal')->middleware('auth');
Route::resource('consejo_comunal', ConsejoComunalController::class)->middleware('auth');
Route::get('/consejo_comunal/detalles/{id}', [ConsejoComunalController::class, 'getconsejocomunalDetalles']);

/* Ruta Comuna */
Route::get('/comuna',  [comunaController::class,'index'])->name('comuna')->middleware('auth');
Route::get('/comuna/create', [ComunaController::class, 'create'])->name('create')->middleware('auth');
Route::get('/comuna/pdf', [ComunaController::class,'pdf'])->name('comuna')->middleware('auth');
Route::resource('comuna', ComunaController::class)->middleware('auth');

/* Rutas Ayuda */
Route::get('/ayuda', [AyudasController::class, 'index'])->name('ayuda')->middleware('auth');
Route::get('/ayuda/create', [AyudasController::class, 'create'])->name('ayuda.create')->middleware('auth');
Route::get('/ayuda/pdf', [AyudasController::class, 'pdf'])->name('ayuda.pdf')->middleware('auth'); // <-- Aquí faltaba el ;
Route::resource('ayuda', AyudasController::class)->middleware('auth');
Route::get('/ayuda/detalles/{id}', [AyudasController::class, 'getayudaDetalles']);

/* Rutas Proyecto */
Route::get('/proyecto', [ProyectosController::class, 'index'])->name('proyecto')->middleware('auth');
Route::get('/proyecto/create', [ProyectosController::class, 'create'])->name('proyecto.create')->middleware('auth');
Route::get('/proyecto/pdf', [ProyectosController::class, 'pdf'])->name('proyecto.pdf')->middleware('auth'); // <-- Aquí faltaba el ;
Route::resource('proyecto', ProyectosController::class)->middleware('auth');
Route::get('/proyecto/detalles/{id}', [ProyectosController::class, 'getproyectoDetalles']);

/* Ruta Responsable */
Route::get('/resposanble',  [ResposanblesController::class,'index'])->name('resposanble')->middleware('auth');
Route::get('/resposanble/create', [ResposanblesController::class, 'create'])->name('create')->middleware('auth');
Route::get('/resposanble/pdf',  [ResposanblesController::class,'pdf'])->name('resposanble')->middleware('auth');
Route::resource('resposanble', ResposanblesController::class)->middleware('auth');

/* Ruta Visita */
Route::get('/visita',  [VisitasController::class,'index'])->name('visita')->middleware('auth');
Route::get('/visita/create', [VisitasController::class, 'create'])->name('create')->middleware('auth');
Route::get('/visita/pdf',  [VisitasController::class,'pdf'])->name('visita')->middleware('auth');
Route::resource('visita', VisitasController::class)->middleware('auth');

/* Rutas Evaluación */
Route::get('/evaluacion', [EvaluacionesController::class, 'index'])->name('evaluacion.index')->middleware('auth');
Route::get('/evaluacion/create', [EvaluacionesController::class, 'create'])->name('evaluacion.create')->middleware('auth');
Route::get('/evaluacion/pdf', [EvaluacionesController::class, 'pdf'])->name('evaluacion.pdf')->middleware('auth');
Route::resource('evaluacion', EvaluacionesController::class)->except(['index', 'create'])->middleware('auth');
Route::post('/actualizar-estatus-evaluacion/{id}', [EvaluacionesController::class, 'actualizarEstatusEvaluacion']);

/* Rutas Asignaciones */
Route::get('/asignacion', [AsignacionesController::class, 'index'])->name('asignacion')->middleware('auth');
Route::get('/asignacion/create', [AsignacionesController::class, 'create'])->name('create')->middleware('auth');
Route::get('/asignacion/create/{id}', [AsignacionesController::class,'create'])->name('asignacion.create')->middleware('auth');
Route::resource('asignacion', AsignacionesController::class)->middleware('auth');

/* Rutas Seguimiento */
Route::get('/seguimiento', [SeguimientoController::class, 'index'])->name('seguimiento')->middleware('auth');
Route::get('/seguimiento/create/{id}', [SeguimientoController::class, 'create'])->name('seguimiento.create')->middleware('auth');
Route::get('/seguimiento/pdf', [SeguimientoController::class, 'pdf'])->name('seguimiento.pdf')->middleware('auth');
Route::resource('seguimiento', SeguimientoController::class)->middleware('auth')->except(['create']); 
Route::get('/seguimiento/detalles/{id}', [SeguimientoController::class, 'getAsignacionDetalles']);

/* Rutas ControlSeguimientos */
Route::get('/controlseguimiento', [ControlSeguimientosController::class, 'index'])->name('controlseguimiento')->middleware('auth'); 

/* Ruta Estadistica*/
Route::get('estadistica', [EstadisticaController::class, 'index'])->name('estadistica')->middleware('auth');

/* Ruta Bitacora*/
Route::get('bitacora', [ReporteController::class, 'bitacora'])->name('bitacora')->middleware('auth');

/* Ruta Manual */
Route::get('/manual',  [ManualController::class,'index'])->name('manual')->middleware('auth');
