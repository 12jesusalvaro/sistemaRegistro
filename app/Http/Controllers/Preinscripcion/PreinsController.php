<?php

namespace App\Http\Controllers\Preinscripcion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facade\SnappyPdf;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Postulante;
use App\Models\TipoDocumento;
use App\Models\Preinscripcion;
use App\Models\Programa;
use App\Models\Mencion;
use App\Models\TipoPrograma;
use App\Models\Convocatoria;
use App\Models\CodigoPago;
use App\Models\PagoInscripcion;

class PreinsController extends Controller
{
    public function obtenerDato(Request $request){
        //$request = new Request;
        $id = $request->user()->id;
        return $id;
    }

    public function index(Request $request){
        try{
            $id = $request->user()->id;
            $result = User::find($id);
            $tipoDocumento = TipoDocumento::find($result->tipo_documento_id);
            //$result = DB::table('postulantes')->select('id', 'nombres', 'apellido_paterno', 'apellido_materno','numero_celular')->where('numero_documento', $dni)->first();
            $datos = [
                "numero_documento" => $result->numero_documento,
                "nombres" => $result->nombres,
                "cant_apellidos" => $result->cant_apellidos,
                "apellido_paterno" => $result->primer_apellido,
                "apellido_materno" => $result->segundo_apellido,
                "tipo_documento" => $tipoDocumento->nombre,
                "email" => $request->user()->email,
                "numero_celular" => $result->celular
            ];
            //$programas = Programa::where('active', 1)->get();
            $tipoEstudios = TipoPrograma::all();
            $ultimaConvocatoria = Convocatoria::latest()->first();

            // Obtener la convocatoria deseada desde la base de datos.
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
            $exists = Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)
                                    ->where('user_id', $request->user()->id)
                                    ->exists();

            if ($exists) {
                    $mencion = $preinscripcion->mencion;
                    $mencion_nombre = $mencion->nombre;

                    $programa = $mencion->programa;
                    $programa_nombre = $programa->nombre;

                    $tipo_programa = $programa->tipoPrograma;
                    $tipo_programa_nombre = $tipo_programa->nombre;


                    return view('preinscripcion.index', compact('datos', 'tipoEstudios','ultimaConvocatoria','tipo_programa_nombre','programa_nombre', 'mencion_nombre'));

            }


            return view('preinscripcion.index', compact('datos', 'tipoEstudios','ultimaConvocatoria'));
        }catch (\Exception $e){
            $datos = [
                "dni" => $result->numero_documento,
                "nombres" => "$result->nombres",
                "cant_apellidos" => $result->cant_apellidos,
                "tipo_documento" => $tipoDocumento->nombre,
                "apellido_paterno" => "$result->primer_apellido",
                "apellido_materno" => "$result->segundo_apellido",
                "email" => $request->user()->email,
                "numero_celular" => "$result->celular"
            ];

            $tipoEstudios = TipoPrograma::all();
            $ultimaConvocatoria = Convocatoria::latest()->first();

            return view('preinscripcion.index', compact('datos', 'tipoEstudios','ultimaConvocatoria'));
        }
    }

    public function obtenerProgramas(Request $request, $tipo_estudio_id)
    {
        //$tipo_estudio_id = $request->tipo_estudio_id;
        $programas = Programa::where('tipo_programa_id', $tipo_estudio_id)
        ->where('active', 1)
        ->get();
        return response()->json($programas);
    }

    public function obtenerMenciones(Request $request, $programaEstudioId)
    {
        $mencions = Mencion::where('programa_id', $programaEstudioId)
        ->where('active', 1)
        ->get();

        return response()->json($mencions);
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos en la solicitud
        $request->validate([
            'user_id' => '',
            'mencion_id' => 'required|exists:mencions,id',
        ]);

        $ultimaConvocatoria = Convocatoria::latest()->first();

        // Crear una nueva instancia de Preinscripcion
        $preinscripcion = new Preinscripcion();
        $preinscripcion->user_id = $request->user()->id;
        $preinscripcion->mencion_id = $request->mencion_id;
        $preinscripcion->convocatoria_id = $ultimaConvocatoria->id;
        $preinscripcion->save();

        //código para asignar los valores  de preinscripcion a los campos del postulante
        $postulante = new Postulante();
        $postulante->preinscripcion()->associate($preinscripcion);
        $postulante->convocatoria_id = $ultimaConvocatoria->id;
        $postulante->save();

        $mencion = Mencion::find($request->mencion_id);
        $codigoMencion = substr($mencion->codigo, 0, 3);

        //code for asign codigo_pagos a pagos_inscripcions
        /*$codigoSinAsignar = CodigoPago::where('estado',0)
            ->orWhere('codigo', 'LIKE', '%'. $codigoMencion.'%')
            ->first();*/

        $codigoSinAsignar = CodigoPago::where(function ($query) use ($codigoMencion) {
            $query->where('estado', 0)
                    ->where('codigo', 'LIKE', '%' . $codigoMencion . '%');
        })->latest()->first();

        if($codigoSinAsignar){
            $pago_inscripcion = new PagoInscripcion();
            $pago_inscripcion->codigo_pagos_id = $codigoSinAsignar->id;
            $pago_inscripcion->save();

            $codigoSinAsignar->estado = 1;
            $codigoSinAsignar->save();

            $preinscripcion->pago_inscripcion_id = $pago_inscripcion->id;
            $preinscripcion->save();
        }else{

        }
        //code for asign dates of pago_inscripcions a preinscripcion

        // Redirigir o responder con una respuesta JSON según tus necesidades
        return redirect()->route('preinscripcion.index')->with('success', 'Los datos de preinscripción se han guardado correctamente.');
    }

    public function pdf(Request $request){
        $postulante = User::find($request->user()->id);
        $image = '/img/logob_m_EPG.png';
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->get()->first();
        $mencion = Mencion::find($preinscripcion->mencion_id);
        $programa = Programa::find($mencion->programa_id);
        $codigo_pago = $preinscripcion->pagoInscripcion->codigoPago;
        $pdf = Pdf::loadView('preinscripcion.pdf', compact('postulante','image','programa', 'mencion','codigo_pago'));
        return $pdf->stream();
    }

}
