<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class FormController extends Controller
{
    public function DatosAnterior(Request $request)
    {
        $dni = $request->user()->dni;
        //$result = DB::table('postulantes')->select('*')->where('numero_documento', $dni)->first();
        $datos = User::find($request->user()->id);
        $currentStep = $result->current_step;

        return view('formulario', compact('currentStep', 'datos'));
    }

    public function index(Request $request){

        return view('formulario');
    }

    public function saveDatosGenerales(Request $request){
        $this->validate($request, [
            //here values
                //is necesary validated
        ]);

        // Actualizar el paso actual
        $currentStep = 4;
        $postulante = Postulante::where('id', $request->user()->postulante_id)->first();
        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->save();
        }

        //save data general of postulantes

    }


}
