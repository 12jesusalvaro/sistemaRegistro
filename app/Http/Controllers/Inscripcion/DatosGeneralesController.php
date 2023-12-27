<?php

namespace App\Http\Controllers\Inscripcion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\Postulante;
use App\Models\Preinscripcion;
use App\Models\TipoPrograma;
use App\Models\Mencion;
use App\Models\Programa;
use App\Models\TipoDocumento;
use App\Models\DatosGeneral;

class DatosGeneralesController extends Controller
{
    public function index(Request $request)
    {
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        $currentStep = $postulante->current_step;
        $studyType = $postulante->Preinscripcion->Mencion->Programa->TipoPrograma->id;

        //$studyType = Postulante::with('preinscripcion.mencion.programa.tipoDePrograma')->find($id);
       //$studyType=Postulante::join('preinscripcions', 'preinscripcions.user_id', '=', 'users.id');

        $result = User::join('preinscripcions', 'preinscripcions.user_id', '=', 'users.id')
             ->join('postulantes', 'postulantes.preinscripcion_id', '=', 'preinscripcions.id')
             ->where('postulantes.id', $postulante->id)
             ->select('users.*')
             ->first();
        $tipoDocumento = TipoDocumento::find($result->tipo_documento_id);

        $datos = [
            "numero_documento" => $result->numero_documento,
                "nombres" => $result->nombres,
                "primer_apellido" => $result->primer_apellido,
                "segundo_apellido" => $result->segundo_apellido,
                "tipo_documento" => $tipoDocumento->nombre,
                "email" => $request->user()->email,
                "numero_celular" => $result->celular
        ];
        return view('inscripcion.index', compact('currentStep','studyType'));
    }

    public function DatosGenerales(Request $request){
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        $currentStep = $postulante->current_step;
        $studyType = $postulante->Preinscripcion->Mencion->Programa->TipoPrograma->id;

        //$studyType = Postulante::with('preinscripcion.mencion.programa.tipoDePrograma')->find($id);
       //$studyType=Postulante::join('preinscripcions', 'preinscripcions.user_id', '=', 'users.id');

        $result = User::join('preinscripcions', 'preinscripcions.user_id', '=', 'users.id')
             ->join('postulantes', 'postulantes.preinscripcion_id', '=', 'preinscripcions.id')
             ->where('postulantes.id', $postulante->id)
             ->select('users.*')
             ->first();
        $tipoDocumento = TipoDocumento::find($result->tipo_documento_id);

        $datos = [
            "numero_documento" => $result->numero_documento,
                "nombres" => $result->nombres,
                "primer_apellido" => $result->primer_apellido,
                "segundo_apellido" => $result->segundo_apellido,
                "tipo_documento" => $tipoDocumento->nombre,
                "email" => $request->user()->email,
                "numero_celular" => $result->celular
        ];
        return view('inscripcion.datos-generales', compact('currentStep', 'datos', 'studyType'));
    }

    public function SaveDatosGenerales(Request $request){
        $datos = $request->validate([
            'cant_apellido_id' => ['required', 'integer'],
            'fecha_nacimiento' => ['required', 'date'],
            'pais_nac_id' => ['required', 'integer'],
            'nacionalidad_id' => ['required', 'integer'],
            'departamento_nac_id' => ['required', 'integer'],
            'provincia_nac_id' => ['required', 'integer'],
            'distrito_nac_id' => ['required', 'integer'],
            'direccion_domiciliaria' => ['required', 'string', 'max:255'],
            'departamento_domic_id' => ['required', 'integer'],
            'provincia_domic_id' => ['required', 'integer'],
            'distrito_domic_id' => ['required', 'integer'],
            'edad' => ['required', 'integer'],
            'estado_civil_id' => ['required', 'integer'],
            'discapacidad_id' => [''],
        ]);

        $datosGeneral = new DatosGeneral();
        $datosGeneral->fill($datos);
        $datosGeneral->save();

        // Obtener el ID de datos_general
        $datosGeneralId = $datosGeneral->id;

        $currentStep = 2;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->datos_general_id = $datosGeneralId;
            $postulante->save();
        }
        return redirect()->route('index', ['step' => $currentStep]);
    }
}
