<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Convocatoria;
use App\Models\User;
use App\Models\Postulante;
use App\Models\Secretaria;
use App\Models\Evaluador;
use App\Models\Puntaje;
use App\Models\Preinscripcion;
use App\Models\Mencion;
use App\Models\CodigoPago;

class ActividadController extends Controller
{
    public function index(Request $request)
    {
        // Obtener la convocatoria deseada desde la base de datos.

        $ultimaConvocatoria = Convocatoria::latest()->first();

        if ($ultimaConvocatoria) {
            $fechaInicio = Carbon::parse($ultimaConvocatoria->fecha_inicio);
            $fechaFin = Carbon::parse($ultimaConvocatoria->fecha_fin);

            // Duración de cada actividad en días
            $duracionActividad1 = 57; //Publicidad e inscripciones
            $duracionActividad2 = 3;  //Calificacion de Expedientes
            $duracionActividad3 = 2;  //Entrevista personal
            $duracionActividad4 = 2;  //Publicación de Resultados

            // Calcular las fechas de las 4 actividades
            $actividad1Inicio = $fechaInicio;
            $actividad1Fin = $actividad1Inicio->copy()->addDays($duracionActividad1);

            $actividad2Inicio = $actividad1Fin->copy()->addDay();
            $actividad2Fin = $actividad2Inicio->copy()->addDays($duracionActividad2);

            $actividad3Inicio = $actividad2Fin->copy()->addDay();
            $actividad3Fin = $actividad3Inicio->copy()->addDays($duracionActividad3);

            $actividad4Inicio = $actividad3Fin->copy()->addDay();
            $actividad4Fin = $actividad4Inicio->copy()->addDays($duracionActividad4);

            $cronograma = [
                "actividad1Inicio" => $actividad1Inicio,
                "actividad1Fin" => $actividad1Fin,
                "actividad2Inicio" => $actividad2Inicio,
                "actividad2Fin" => $actividad2Fin,
                "actividad3Inicio" => $actividad3Inicio,
                "actividad3Fin" => $actividad3Fin,
                "actividad4Inicio" => $actividad4Inicio,
                "actividad4Fin" => $actividad4Fin
            ];
        }else{
            $cronograma = [
                "actividad1Inicio" => 0,
                "actividad1Fin" => 0,
                "actividad2Inicio" => 0,
                "actividad2Fin" => 0,
                "actividad3Inicio" => 0,
                "actividad3Fin" => 0,
                "actividad4Inicio" => 0,
                "actividad4Fin" => 0
            ];
        }

        /*code to get show information in panel of admins*/
        if(Auth::check() && Auth::user()->hasRole('Admin')){

            //$postulantes = Postulante::where();
            return view('dashboard', compact('cronograma')); //->compact('cronograma');
        }

        if(Auth::user()->hasRole('Postulante')){
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();

            $exists = Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)
                                   ->where('user_id', $request->user()->id)
                                   ->exists();

            //if($preinscripcion==NULL && $exists == FALSE){
            if($exists){
                $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
                $currentStep = $postulante->current_step;
                $mencion_id = $preinscripcion->mencion_id;
                $mencion = Mencion::where('id', $mencion_id)->first();
                $mencion_nombre = $mencion->nombre;
                $codigo_pago = $preinscripcion->pagoInscripcion->codigoPago;
                $pago_inscripcion = $preinscripcion->pagoInscripcion;
                $estado_pago = $pago_inscripcion->estado_pago;

            }
            else{
                $currentStep=0;
                $mencion_nombre=0;
                $estado_pago=0;
            }

            $progress=intval($currentStep * 100 / 7);

            // Pasar las fechas de las actividades a la vista del dashboard utilizando sesiones.
            return view('dashboard', compact('currentStep','progress','mencion_nombre', 'cronograma','estado_pago')); //->compact('cronograma');
        }


        /*code to get numnber of preinscritos for panel of secretarias*/
        if(Auth::check() && Auth::user()->hasRole('Secretaria')){
            $secretaria = Secretaria::where('user_id', $request->user()->id)->first();

            $preinscritos = Preinscripcion::where('mencion_id', $secretaria->mencion_id)
                        ->where('convocatoria_id',$ultimaConvocatoria->id)
                        ->count();

            //$validados = Preinscripcion::();
            $validados = Preinscripcion::whereHas('pagoInscripcion', function ($query) use ($ultimaConvocatoria, $secretaria){
                $query->where('estado_pago', 1)
                    ->where('convocatoria_id',$ultimaConvocatoria->id)
                    ->where('mencion_id', $secretaria->mencion_id);
            })->count();

            $postulantesPorCurrentStep = [];

            for ($i = 0; $i <= 7; $i++) {
                // Realizamos una consulta para contar los postulantes con el current_step actual
                $cantidad = Postulante::where('current_step', $i+1)
                            ->where('convocatoria_id',$ultimaConvocatoria->id)
                            ->whereHas('preinscripcion', function ($query) use ($secretaria) {
                                $query->where('mencion_id', $secretaria->mencion_id);
                            })
                            ->count();
                // Almacenamos la cantidad en el array
                $postulantesPorCurrentStep[$i] = $cantidad;
            }

            //$postulantes = Postulante::where();
            return view('dashboard', compact('cronograma', 'preinscritos', 'validados', 'postulantesPorCurrentStep')); //->compact('cronograma');
        }

        /*code to get numnber of evaluados for panel of evaluadores*/
        if(Auth::check() && Auth::user()->hasRole('Evaluador')){
            $evaluador = Evaluador::where('user_id', $request->user()->id)->first();

            $evaluados = Postulante::whereHas('preinscripcion', function ($query) use ($evaluador, $ultimaConvocatoria) {
                $query->where('mencion_id', $evaluador->mencion_id)
                    ->where('convocatoria_id', $ultimaConvocatoria->id);
            })
            ->whereHas('puntajes', function ($query) {
                $query->whereNotNull('nota_total');
            })
            ->count();

            $evaluadosEnProceso = Postulante::whereHas('preinscripcion', function ($query) use ($evaluador, $ultimaConvocatoria) {
                $query->where('mencion_id', $evaluador->mencion_id)
                    ->where('convocatoria_id', $ultimaConvocatoria->id);
            })
            ->whereHas('puntajes', function ($query) {
                $query->whereNotNull('nota_parcial1')
                ->where('nota_parcial2', NULL);
            })
            ->count();

            $Noevaluados = Postulante::whereHas('preinscripcion', function ($query) use ($evaluador, $ultimaConvocatoria) {
                $query->where('mencion_id', $evaluador->mencion_id)
                    ->where('convocatoria_id', $ultimaConvocatoria->id);
            })
            ->whereHas('puntajes', function ($query) {
                $query->where('nota_total',  NULL);
            })
            ->count();

            //$postulantes = Postulante::where();
            $currentStep =0;
            return view('dashboard', compact('cronograma', 'evaluados', 'Noevaluados', 'evaluadosEnProceso')); //->compact('cronograma');
        }

        if(Auth::check() && Auth::user()->hasRole('Contador')){
            //$porPagar = Evaluador::where('user_id', $request->user()->id)->first();

            //$postulantes = Postulante::where();
            $currentStep =0;
            return view('dashboard', compact('cronograma')); //->compact('cronograma');
        }
    }
}
