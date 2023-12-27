<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\DatosVoucher;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
    $file = $request->file('file'); // Obtén el archivo CSV del formulario
    //dd($file);
    Excel::import(new DatosVoucher, $file); // Importa los datos utilizando TuImport

    return redirect()->back()->with('success', 'Los datos se importaron con éxito.');
    }

}
