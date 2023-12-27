<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convocatoria;
use App\Models\Secretaria;
use App\Models\Evaluador;

use App\Models\Mencion;
use App\Models\TipoPrograma;
use App\Models\Programa;
use App\Models\HistorialMencion;

use App\Models\CodigoPago;
use App\Models\ProcesoAdmision;

use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;

class ConvocatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use WithPagination;
    public $search;
    public function index(Request $request)
    {
        $search = trim($request->input('search'));   //trim borra espacios en blanco al inicio y final

        $convocatorias= Convocatoria::where('nombre', 'LIKE','%'.$search.'%')
            ->orWhere('anio', 'LIKE', '%'. $search.'%')
            ->paginate(10);

        return view('admin.convocatoria.index', compact('convocatorias', 'search'));
    }

    public function generarCodigo() {
        $year = date('y') % 100;

        $menciones = Mencion::all();
        $ultimaConvocatoria = Convocatoria::latest()->first();
        $numConvocatoria = $ultimaConvocatoria->numero;
        foreach ($menciones as $mencion) {
            $codigoMencion = substr($mencion->codigo, 0, 3); // Asegúrate de usar la propiedad correcta para el código de mención
            $numeroVacantes = $mencion->vacantes;

            // Generar un código por cada vacante
            for ($i = 1; $i <= $numeroVacantes; $i++) {
                $numeroVacante = str_pad($i, 3, '0', STR_PAD_LEFT);
                $codigoGenerado = $year . $numConvocatoria. $codigoMencion . $numeroVacante;

                // Crear un nuevo registro en la tabla codigo_pagos
                $codigoPago = new CodigoPago();
                $codigoPago->codigo = $codigoGenerado;
                $codigoPago->save();
            }
        }
    }

    public function create()
    {
        $convocatorias =Convocatoria::all();
        $proceso_admision = ProcesoAdmision::all();

        $tipo_estudios= TipoPrograma::all();
        $tipo_programas=Programa::all();
        $menciones = Mencion::all();
        //dd($tipo_programas);
        return view('admin.convocatoria.create', compact('menciones','tipo_estudios','tipo_programas','proceso_admision'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'anio' => 'required',
            'numero' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'fecha_inicio_carga' => 'required',
            'fecha_fin_carga' => 'required',

        ]);

        $convocatoria = new Convocatoria([
            'nombre' => $request->input('nombre'),
            'anio' => $request->input('anio'),
            'numero' => $request->input('numero'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_final' => $request->input('fecha_final'),
            'fecha_inicio_carga' => $request->input('fecha_inicio_carga'),
            'fecha_fin_carga' => $request->input('fecha_fin_carga'),

        ]);
        $convocatoria->save();
        $this->generarCodigo();
        return redirect()->route('admin.convocatoria.index' );

    }

    public function pdf(){
        $convocatorias=Convocatoria::all();
        $pdf = Pdf::loadView('admin.convocatoria.pdf', compact('convocatorias'));
        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //convocatoria
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $convocatoria = Convocatoria::find($id);
        $info=[
            'nombre' => $convocatoria->nombre,
            'anio' => $convocatoria->anio,
            'numero' => $convocatoria->numero,
            'fecha_inicio' => $convocatoria->fecha_inicio,
            'fecha_final' => $convocatoria->fecha_final,
            'fecha_inicio_carga' => $convocatoria->fecha_inicio_carga,
            'fecha_fin_carga' => $convocatoria->fecha_fin_carga

        ];
        //dd($convocatoria->nombre);
        $proceso_admision = ProcesoAdmision::all();
        $tipo_estudios= TipoPrograma::all();
        $tipo_programas=Programa::all();
        $menciones = Mencion::all();
        return view('admin.convocatoria.edit', compact('info','menciones','tipo_estudios','tipo_programas','proceso_admision','convocatoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'nombre' => 'required',
            'anio' => 'required',
            'numero' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'fecha_inicio_carga' => 'required',
            'fecha_fin_carga' => 'required',
            'programa_ids' => 'array',
            'mencion_ids' => 'array',
            'mencion_vacantes' => 'array',
            'mencion_montos' => 'array',
        ]);

        $convocatoria = Convocatoria::findOrFail($id);

        // Actualizar campos básicos de la convocatoria
        $convocatoria->update([
            'nombre' => $request->input('nombre'),
            'anio' => $request->input('anio'),
            'numero' => $request->input('numero'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_final' => $request->input('fecha_final'),
            'fecha_inicio_carga' => $request->input('fecha_inicio_carga'),
            'fecha_fin_carga' => $request->input('fecha_fin_carga'),
        ]);
        $mencionIds = $request->input('mencion_ids', []);
        $mencionVacantes = $request->input('mencion_vacantes', []);
        $mencionMontos = $request->input('mencion_montos', []);
        DB::table('mencions')->whereIn('id', $mencionIds)->update(['active' => 1]);
        // Actualizar el estado para menciones no marcadas
        //Mencion::whereNotIn('id', $mencionIds)->update(['estado' => 0]);

        DB::table('mencions')->whereNotIn('id', $mencionIds )->update(['active' => 0]);
       //  dd($mencionIds);
       // Obtén los datos del formulario
        foreach ($mencionIds as $index => $mencionId) {
            // Accede a los valores correspondientes de vacantes y montos
            $vacantes = $mencionVacantes[$index];
            $monto = $mencionMontos[$index];

            // Aquí puedes realizar las operaciones que necesites con $vacantes y $monto
            // Por ejemplo, puedes almacenarlos en la base de datos


            DB::table('mencions')->where('id', $mencionId)->update([
                'vacantes' => $vacantes,
                'monto' => $monto,
            ]);
        }

        return redirect()->route('admin.convocatoria.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Convocatoria::find($id)->delete();
        return redirect()->route('admin.convocatoria.index')->with('eliminar', 'ok');
    }
    public function convocatoria()
    {
        $tipo_programas = TipoPrograma::all();

        return view('admin.convocatoria.convocatoria', compact('tipo_programas'));
    }

    public function obtenerProgramas(Request $request)
    {
        $programa_ids = $request->input('programa_ids');
        $programas = Programa::whereIn('tipo_programa_id', $programa_ids)->get();
        $menciones = Mencion::whereIn('programa_id', $programa_ids)->get();

        return response()->json([
            'programas' => $programas,
            'menciones' => $menciones,
        ]);
    }

    public function cvguardar(Request $request){

    $tipoEstudioIds = $request->input('tipo_estudio_ids', []);
    $programaIds = $request->input('programa_ids', []);
    $mencionIds = $request->input('mencion_ids', []);
    $mencionVacantes = $request->input('mencion_vacantes', []);
    $mencionMontos = $request->input('mencion_montos', []);
    //dd($mencionIds,$mencionVacantes,$mencionMontos);
    $request->validate([
        'nombre' => 'required',
        'anio' => 'required',
        'numero' => 'required',
        'fecha_inicio' => 'required',
        'fecha_final' => 'required',
        'fecha_inicio_carga' => 'required',
        'fecha_fin_carga' => 'required',

    ]);

    $convocatoria = new Convocatoria([
        'nombre' => $request->input('nombre'),
        'anio' => $request->input('anio'),
        'numero' => $request->input('numero'),
        'fecha_inicio' => $request->input('fecha_inicio'),
        'fecha_final' => $request->input('fecha_final'),
        'fecha_inicio_carga' => $request->input('fecha_inicio_carga'),
        'fecha_fin_carga' => $request->input('fecha_fin_carga'),

    ]);


    // Actualizar el estado para tipos de estudio marcados
    //TipoEstudio::whereIn('id', $tipoEstudioIds)->update(['estado' => 1]);
    DB::table('tipo_programas')->whereIn('id', $tipoEstudioIds)->update(['active' => 1]);
    // Actualizar el estado para tipos de estudio no marcados
    //TipoEstudio::whereNotIn('id', $tipoEstudioIds)->update(['estado' => 0]);
    DB::table('tipo_programas')->whereNotIn('id', $tipoEstudioIds)->update(['active' => 0]);
    // Actualizar el estado para programas marcados
    //Programa::whereIn('id', $programaIds)->update(['estado' => 1]);
    DB::table('programas')->whereIn('id', $programaIds)->update(['active' => 1]);
    // Actualizar el estado para programas no marcados
    //Programa::whereNotIn('id', $programaIds)->update(['estado' => 0]);
    DB::table('programas')->whereNotIn('id', $programaIds)->update(['active' => 0]);
    // Actualizar el estado para menciones marcadas
    //Mencion::whereIn('id', $mencionIds)->update(['estado' => 1]);
    DB::table('mencions')->whereIn('id', $mencionIds)->update(['active' => 1]);
    // Actualizar el estado para menciones no marcadas
    //Mencion::whereNotIn('id', $mencionIds)->update(['estado' => 0]);

    // Hacer lo que necesites con los datos
    DB::table('mencions')->whereNotIn('id', $mencionIds )->update(['active' => 0]);
    // Ejemplo de cómo imprimir los datos para verificar
    // Obtén los datos del formulario
    foreach ($mencionIds as $index => $mencionId) {
        // Accede a los valores correspondientes de vacantes y montos
        $vacantes = $mencionVacantes[$index];
        $monto = $mencionMontos[$index];

        // Aquí puedes realizar las operaciones que necesites con $vacantes y $monto
        // Por ejemplo, puedes almacenarlos en la base de datos


        DB::table('mencions')->where('id', $mencionId)->update([
            'vacantes' => $vacantes,
            'monto' => $monto,
        ]);
    }
    $this->guardarhistorial();
    $convocatoria->save();
    $this->generarCodigo();
    return redirect()->route('admin.convocatoria.index' );
    //dd($tipoEstudioIds, $programaIds, $mencionIds,$montos_edit,$n_vacantes_edit);
    }

    public function guardarhistorial(){
    // Obtener el ID de la última convocatoria
    $ultimaConvocatoriaId = Convocatoria::latest('id')->first()->id;

    // Obtener la información de todas las menciones
    $menciones = Mencion::all();

    // Crear un array para almacenar la información del historial
    $historial = [];

    foreach ($menciones as $mencion) {
        // Acceder a la información necesaria de cada mención
        $historialItem = [
            'convocatoria_id' => $ultimaConvocatoriaId,
            'mencion_id' => $mencion->id,
            'vacantes' => $mencion->vacantes,
            'costo' => $mencion->monto,
        ];

        // Agregar el item al array del historial
        $historial[] = $historialItem;
    }

    // Guardar la información en la tabla de historial (suponiendo que tienes una tabla llamada 'historial')
    DB::table('historial_menciones')->insert($historial);
}
}
