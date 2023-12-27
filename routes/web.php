<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReniecController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Preinscripcion\PreinsController;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\ConvocatoriaController;
use App\Http\Controllers\Admin\ProcesoAdmisionController;
use App\Http\Controllers\Secretaria\SecretariaController;
use App\Http\Controllers\Evaluador\EvaluadorController;
use App\Http\Controllers\Contador\ContadorController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\Inscripcion\DatosGeneralesController;
use App\Http\Controllers\Inscripcion\InfAcademicaController;

use App\Http\Controllers\UploadController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\CropImageController;
use App\Http\Controllers\PagoInscripcionController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    Route::view('/login','auth.login')->name('login');

});


//Route::get('/dashboard', 'ReniecController@DatosReniec')->name('DatosReniec');

// to verificated email before to into the sistem
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/dashboard', [ActividadController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


//para usar el controlador y retornar los datos del controlador
//Route::get('/dashboard', [ReniecController::class, 'DatosReniec'])->middleware(['auth', 'verified'])->name('dashboard');

/* //para entrar sin tener el correo registrado
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

/*
Route::get('/formulario', function () {
    return view('formulario');
})->middleware(['auth', 'verified'])->name('formulario');
*/
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::view('/preinscripcion','index')->name('preinscripcion.index');
    Route::get('/preinscripcion', [PreinsController::class, 'index'])->name('preinscripcion.index');
    Route::get('/preinscripcion/pdf/', [PreinsController::class, 'pdf'])->name('preinscripcion.pdf');
    Route::post('/preinscripcion', [PreinsController::class, 'store'])->name('preinscripcion.guardarDato');
    Route::post('/preinscripcion/codigos', [PreinsController::class, 'generarCodigo'])->name('preinscripcion.codigos');
    //Route::post('/validarpagos', [PagoInscripcionController::class, 'validarPago'])->name('validarPago');
    //Route::get('/obtener-programas/{tipoEstudioId}', [PreinsController::class, 'obtenerProgramas'])->name('obtener-programas');
    //Route::get('/obtener-menciones/{programaEstudioId}',[PreinsController::class, 'obtenerMenciones'])->name('obtener-menciones');
    Route::get('/obtener-programas/{tipoEstudioId}', [PreinsController::class, 'obtenerProgramas']);
    Route::get('/obtener-menciones/{programaEstudioId}',[PreinsController::class, 'obtenerMenciones']);
    Route::get('preinscripcion/validarpago', [PagoInscripcionController::class, 'index'])->name('preinscripcion.validarPago');
    Route::post('preinscripcion/validarpago', [PagoInscripcionController::class, 'validarPago'])->name('validarPago');

});


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/inscripcion',[DatosGeneralesController::class, 'index'])->name('inscripcion.index');
    Route::get('/inscripcion/DatosGenerales',[DatosGeneralesController::class, 'DatosGenerales'])->name('inscripcion.datosGenerales');
    Route::post('/inscripcion/saveDatosgenerales',[DatosGeneralesController::class, 'SaveDatosGenerales'])->name('inscripcion.saveDatosGenerales');
    Route::post('/inscripcion/saveInfoAcademica',[InfAcademicaController::class, 'SaveInfoAcademica'])->name('inscripcion.saveInfoAcademica');
});


//rutas para guardar los datos de inscripcion
Route::group(['middleware' => ['auth', 'verified']], function () {
Route::get('/formulario', [ReniecController::class, 'DatosReniec'])->middleware(['auth', 'verified'])->name('formulario');

Route::post('/formulario/guardar-datos-generales', [ReniecController::class, 'guardarDatos'])
    ->name('formulario.guardar.datos_generales');

Route::get('/provincias', [ReniecController::class, 'getProvinciasByDepartamento'])->name('ubigeo.provincias');
Route::get('/distritos', [ReniecController::class, 'getDistritosByProvincia'])->name('ubigeo.distritos');

Route::post('/formulario/guardar-informacion-academica', [ReniecController::class, 'guardarInformacionAcademica'])
    ->name('formulario.guardar.informacion_academica');

    Route::post('/formulario/guardar-informacion-academica2', [ReniecController::class, 'guardarInformacionAcademica2'])
    ->name('formulario.guardar.informacion_academica2');

    Route::post('/formulario/guardar-experiencia-profecional', [ReniecController::class, 'guardarExperienciaProfecional'])
    ->name('formulario.guardar.experiencia_profecional');
    Route::post('/formulario/guardar-produccion-cientifica', [ReniecController::class, 'guardarProduccionCientifica'])
    ->name('formulario.guardar.produccion_cientifica');

    Route::post('/formulario/guardar-idiomas', [ReniecController::class, 'guardarIdiomas'])
    ->name('formulario.guardar.idiomas');
    Route::post('/formulario/subir-archivos', [ReniecController::class, 'guardarSubirArchivos'])
    ->name('formulario.guardar.subir_archivos');

    Route::post('/upload', [UploadController::class, 'store'])->name('upload');

    Route::get('/finalizado', [ReniecController::class, 'guardarSubirArchivos'])
    ->name('finalizado');
});
//Cargar documentos a la BD
//Route::post('/upload', [UploadController::class, 'store'])->name('upload');

Route::middleware('auth')->group(function () {
    //cropper
    Route::get('/pagina-recortar', [CropImageController::class, 'index'])->name('pagina.recorte');
    Route::get('formulario-recorte', [ReniecController::class, 'mostrarFormulario'])->name('formulario.foto');

    Route::post('crop-image-upload-ajax', [CropImageController::class, 'cropImageUploadAjax']);
    //Generar documentos
    Route::get('/generate-pdf1',[PdfController::class,'PdfSolicitud'])->name('solicitudpdf');
    Route::get('/generate-pdf2',[PdfController::class,'PdfDeclaracion'])->name('declaracion.pdf');
    Route::get('/generate-pdf3',[PdfController::class,'PdfCarta'])->name('carta.pdf');
    Route::get('/generate-pdf4',[PdfController::class,'PdfInscripcion'])->name('inscripcion.pdf');

    Route::post('/upload-pdf',[PdfController::class, 'upload'])->name('uploadinscripcion.pdf');
    // Ruta para procesar el formulario enviado
    //Route::post('/formulario', [FormularioController::class, 'formulario'] )->name('formulario.submit');

    Route::post('/documentos', [DocumentosController::class, 'store'])->name('documentos.store');

    //exportar reporte en excel---------------------------------
    Route::get('/export',[ExportController::class,'export'])->name('export');

    //importar desde un .csv
    Route::post('/import',[ImportController::class,'import'])->name('import');
});

Route::middleware('auth')->group(function () {
    Route::view('/','welcome')->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::view('/admin','index')->name('admin.users.index');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/pdf', [UserController::class, 'pdf'])->name('admin.users.pdf');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/users/{id}', [UserController::class, 'update']);
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::view('/roles','index')->name('admin.roles.index');
    Route::get('/roles', [RolController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles/create', [RolController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [RolController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/{id}', [RolController::class, 'show'])->name('admin.roles.show');
    Route::get('/roles/{id}/edit', [RolController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles/{id}', [RolController::class, 'update'])->name('admin.roles.update');
    Route::patch('/roles/{id}', [RolController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{id}', [RolController::class, 'destroy'])->name('admin.roles.destroy');
});

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::view('/admin','index')->name('admin.convocatoria.index');
    Route::get('/convocatoria', [ConvocatoriaController::class, 'index'])->name('admin.convocatoria.index');
    Route::get('/convocatoria/pdf', [ConvocatoriaController::class, 'pdf'])->name('admin.convocatoria.pdf');
    Route::get('/convocatoria/create', [ConvocatoriaController::class, 'create'])->name('admin.convocatoria.create');
    Route::post('/convocatoria', [ConvocatoriaController::class, 'store'])->name('admin.convocatoria.store');
    Route::get('/convocatoria/{Convocatoria}', [ConvocatoriaController::class, 'show'])->name('admin.convocatoria.show');
    Route::get('/convocatoria/{Convocatoria}/edit', [ConvocatoriaController::class, 'edit'])->name('admin.convocatoria.edit');
    Route::patch('/convocatoria/{id}', [ConvocatoriaController::class, 'update']);
    Route::put('/convocatoria/{Convocatoria}', [ConvocatoriaController::class, 'update'])->name('admin.convocatoria.update');
    Route::delete('/convocatoria/{Convocatoria}', [ConvocatoriaController::class, 'destroy'])->name('admin.convocatoria.destroy');

    //pruebas para modificar el estado de los programas y menciones
    Route::get('/crearconvocatoria',[ConvocatoriaController::class, 'convocatoria'])->name('admin.convocatoria.crear');
    Route::post('/obtener-programas', [ConvocatoriaController::class, 'obtenerProgramas'])->name('admin.convocatorias.obtenerProgramas');
    Route::post('/crear-convocatoria',[ConvocatoriaController::class, 'cvguardar'])->name('admin.convocatoria.guardar');
});


//rutas para secretaria
Route::group(['middleware' => ['auth', 'verified', 'role:Secretaria']], function () {
    //Route::view('/secretari','index')->name('secretaria.index');
    Route::get('/secretaria', [SecretariaController::class, 'index'])->name('secretaria.index');
    Route::get('/secretaria/postulantes', [SecretariaController::class, 'postulantes'])->name('secretaria.postulantes');
    Route::get('/secretaria/reportePDF', [SecretariaController::class, 'report'])->name('secretaria.reporte');
    Route::get('/secretaria/create', [SecretariaController::class, 'create'])->name('secretaria.create');
    Route::post('/secretaria', [SecretariaController::class, 'store'])->name('secretaria.store');
    Route::get('/secretaria/{id}', [SecretariaController::class, 'show'])->name('secretaria.show');
    Route::get('/secretaria/{user}/edit', [SecretariaController::class, 'edit'])->name('secretaria.edit');
    Route::get('/secretaria/{user}/validar', [SecretariaController::class, 'validar'])->name('secretaria.validar');
    Route::patch('/secretaria/{id}', [SecretariaController::class, 'update']);
    Route::put('/secretaria/{user}', [SecretariaController::class, 'update'])->name('secretaria.update');
    Route::delete('/secretaria/{id}', [SecretariaController::class, 'destroy'])->name('secretaria.destroy');
    //route to get preinscritos, postulantes by convocatoria and search users
    Route::get('/obtener-preinscritos/{convocatoriaId}',  [SecretariaController::class, 'preinscritosByConvocatoria'])->name('obtener-preinscritos');
    Route::get('/obtener-postulantes/{convocatoriaId}',  [SecretariaController::class, 'postulantesByConvocatoria'])->name('obtener-postulantes');
    Route::get('/convocatorias/search/', [SecretariaController::class, 'search'])->name('secretaria.search');
});

//routes for procesos
Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::view('/admin','index')->name('admin.procesos.index');
    Route::get('/procesos', [ProcesoAdmisionController::class, 'index'])->name('admin.procesos.index');
    Route::get('/procesos/pdf', [ProcesoAdmisionController::class, 'pdf'])->name('admin.procesos.pdf');
    Route::get('/procesos/create', [ProcesoAdmisionController::class, 'create'])->name('admin.procesos.create');
    Route::post('/procesos', [ProcesoAdmisionController::class, 'store'])->name('admin.procesos.store');
    Route::get('/procesos/{Proceso}', [ProcesoAdmisionController::class, 'show'])->name('admin.procesos.show');
    Route::get('/procesos/{Proceso}/edit', [ProcesoAdmisionController::class, 'edit'])->name('admin.procesos.edit');
    Route::patch('/procesos/{id}', [ProcesoAdmisionController::class, 'update']);
    Route::put('/procesos/{Proceso}', [ProcesoAdmisionController::class, 'update'])->name('admin.procesos.update');
    Route::delete('/procesos/{Proceso}', [ProcesoAdmisionController::class, 'destroy'])->name('admin.procesos.destroy');
});

//rutas para evaluador
Route::group(['middleware' => ['auth', 'verified', 'role:Evaluador']], function () {
    Route::view('/evaluadpr','index')->name('evaluador.index');
    Route::get('/evaluador', [EvaluadorController::class, 'index'])->name('evaluador.index');
    Route::get('/evaluador/reportePDF', [EvaluadorController::class, 'pdf'])->name('evaluador.reporte');
    Route::get('/evaluador/create', [EvaluadorController::class, 'create'])->name('evaluador.create');
    Route::post('/evaluador', [EvaluadorController::class, 'store'])->name('evaluador.store');
    Route::get('/evaluador/{id}', [EvaluadorController::class, 'show'])->name('evaluador.show');
    Route::get('/evaluador/{id}/evaluacion_expediente', [EvaluadorController::class, 'editExpediente'])->name('evaluador.editExpediente');
    Route::get('/evaluador/{id}/evaluacion_entrevista', [EvaluadorController::class, 'editEntrevista'])->name('evaluador.editEntrevista');
    Route::put('/evaluador/{id}', [EvaluadorController::class, 'update'])->name('evaluador.update');
    Route::patch('/evaluador/{id}', [EvaluadorController::class, 'update'])->name('evaluador.update');
    Route::delete('/evaluador/{id}', [EvaluadorController::class, 'destroy'])->name('evaluador.destroy');
    Route::post('/evaluador/{id}', [EvaluadorController::class, 'calificarExpediente'])->name('evaluador.calificarExped');
    Route::post('/evaluadors/{id}', [EvaluadorController::class, 'calificarEntrevista'])->name('evaluador.calificarEntrev');

    //visualizar datos de la inscrpcion de cada postulante con el id
    Route::get('visualizar1-pdf/{id}', [EvaluadorController::class, 'fichaInscripcion'])->name('verinscripcion.pdf');
    Route::get('visualizar2-pdf/{id}', [EvaluadorController::class, 'proyectoInvest'])->name('verinvestigacion.pdf');
    Route::get('visualizar3-pdf/{id}', [EvaluadorController::class, 'CV'])->name('vercv.pdf');
    Route::get('visualizar4-pdf/{id}', [EvaluadorController::class, 'GradoAcademico'])->name('vergradoacademico.pdf');

});

//rutas para contador
Route::group(['middleware' => ['auth', 'verified', 'role:Contador']], function () {
    Route::view('/contador','index')->name('contador.index');
    Route::get('/contador', [ContadorController::class, 'index'])->name('contador.index');
    Route::get('/contador/pagos', [ContadorController::class, 'pagos'])->name('contador.pagos');
    Route::get('/contador/create', [ContadorController::class, 'create'])->name('contador.create');
    Route::post('/contador', [ContadorController::class, 'store'])->name('contador.store');
    Route::get('/contador/{id}', [ContadorController::class, 'show'])->name('contador.show');
    Route::get('/contador/{id}/evaluacion_expediente', [ContadorController::class, 'editExpediente'])->name('contador.editExpediente');
    Route::get('/contador/{id}/evaluacion_entrevista', [ContadorController::class, 'editEntrevista'])->name('contador.editEntrevista');
    Route::put('/contador/{id}', [ContadorController::class, 'update'])->name('contador.update');
    Route::patch('/contador/{id}', [ContadorController::class, 'update'])->name('contador.update');
    Route::delete('/contador/{id}', [ContadorController::class, 'destroy'])->name('contador.destroy');
    Route::post('/contador/{id}', [ContadorController::class, 'calificarExpediente'])->name('contador.calificarExped');
    Route::post('/contadors/{id}', [ContadorController::class, 'calificarEntrevista'])->name('contador.calificarEntrev');

    //visualizar datos de la inscrpcion de cada postulante con el id
    Route::get('visualizar1-pdf/{id}', [ContadorController::class, 'fichaInscripcion'])->name('verinscripcion.pdf');
    Route::get('visualizar2-pdf/{id}', [ContadorController::class, 'proyectoInvest'])->name('verinvestigacion.pdf');
    Route::get('visualizar3-pdf/{id}', [ContadorController::class, 'CV'])->name('vercv.pdf');
    Route::get('visualizar4-pdf/{id}', [ContadorController::class, 'GradoAcademico'])->name('vergradoacademico.pdf');

});

require __DIR__.'/auth.php';
