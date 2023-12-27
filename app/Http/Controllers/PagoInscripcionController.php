<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Postulante;
use App\Models\Preinscripcion;
use App\Models\CodigoPago;
use App\Models\Deposito;

class PagoInscripcionController extends Controller
{
    public function index(Request $request){

        $postulante = User::find($request->user()->id);
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $codigo_pago = $preinscripcion->pagoInscripcion->codigoPago;

        $monto = $preinscripcion->mencion;
        return view('preinscripcion.validarpago', compact('codigo_pago'));
    }

    public function validarPago(Request $request){

        $postulante = User::find($request->user()->id);
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $codigo_pago = $preinscripcion->pagoInscripcion->codigoPago;
        $pago_inscripcion = $preinscripcion->pagoInscripcion;

        $deposito = Deposito::where('codigo_usuario', $codigo_pago->codigo)->first();

        $monto = $preinscripcion->mencion;
        // Validar los datos recibidos en la solicitud
        $request->validate([
            'fecha_pago' => 'required|date',
            'numero_operacion' => 'required|max:20',
            'monto' => 'required|numeric|min:0',
            'voucher_pago' => '',
        ]);

        $pago_inscripcion->fecha_pago = $request->fecha_pago;
        $pago_inscripcion->numero_operacion = $request->numero_operacion;
        $pago_inscripcion->monto = $request->monto;
        $pago_inscripcion->voucher_pago = 1;
        $pago_inscripcion->save();

        /*code to validate pago and update estadoPago*/

        /*
            *en esta parte del codigo debemos de considerar
            el deposito_id
            comprobable_id
            operacion
            numero
            monto
            fecha
        */
        //dd($request->fecha_pago );
        if ($deposito->importe == $request->monto && $deposito->fecha == $request->fecha_pago && $deposito->operacion == $request->numero_operacion &&
        $deposito->codigo_usuario == $codigo_pago->codigo) {
            $pago_inscripcion->estado_pago = 1;
            $pago_inscripcion->save();
            return redirect()->route('preinscripcion.index')->with('success', 'Los datos de pago se han guardado correctamente.');
        }else{
            return redirect()->route('preinscripcion.validarPago')->with('error', 'Los datos de pago no coinciden.');
        }
        //dd($monto->monto);
        //return redirect()->route('preinscripcion.index')->with('success', 'Los datos de pago se han guardado correctamente.');
    }
}
