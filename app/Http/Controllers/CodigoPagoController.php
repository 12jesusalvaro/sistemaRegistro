<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Postulante;
use App\Models\Mencion;


class CodigoPagoController extends Controller
{
    function index(){

    }

    /* function to create new codes for pagos */
    function CreateNewCodes(){
        $year = date('y') % 100;

        $menciones = Mencion::all();

        foreach ($menciones as $mencion) {
            $codigoMencion = substr($mencion->codigo, 0, 2); // Asegúrate de usar la propiedad correcta para el código de mención
            $numeroVacantes = $mencion->vacantes;

            // Generar un código por cada vacante
            for ($i = 1; $i <= $numeroVacantes; $i++) {
                $numeroVacante = str_pad($i, 4, '0', STR_PAD_LEFT);
                $codigoGenerado = $year . $codigoMencion . $numeroVacante;

                // Crear un nuevo registro en la tabla codigo_pagos
                $codigoPago = new CodigoPago();
                $codigoPago->codigo = $codigoGenerado;
                $codigoPago->save();
            }
        }

        return redirect()->route('preinscripcion.index')->with('success', 'Los códigos se generaron correctamente.');
    }
}
