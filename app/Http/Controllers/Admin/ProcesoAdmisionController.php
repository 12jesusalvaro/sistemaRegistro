<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Secretaria;
use App\Models\Evaluador;
use App\Models\Mencion;
use App\Models\TipoPrograma;
use App\Models\ProcesoAdmision;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;

class ProcesoAdmisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use WithPagination;
    public function index(Request $request)
    {
        $search = trim($request->input('search'));   //trim borra espacios en blanco al inicio y final
        $convocatorias= ProcesoAdmision::where('nombre', 'LIKE','%'.$search.'%')
            ->paginate(10);

        return view('admin.procesos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //$convocatorias =Convocatoria::all();
        $tipo_programa= TipoPrograma::all();
        $proceso_admision = ProcesoAdmision::all();

        return view('admin.procesos.create', compact('tipo_programa','proceso_admision'));

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
            'tipo_programa_id' => 'required',
        ]);

        $convocatoria = new Convocatoria([
            'nombre' => $request->input('nombre'),
            'anio' => $request->input('anio'),
            'numero' => $request->input('numero'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_final' => $request->input('fecha_final'),
            'fecha_inicio_carga' => $request->input('fecha_inicio_carga'),
            'fecha_fin_carga' => $request->input('fecha_fin_carga'),
            'tipo_programa_id' => $request->input('tipo_programa_id'),

        ]);
        $convocatoria->save();

        return redirect()->route('admin.procesos.index' );
    }

    public function pdf(){
        $convocatorias=Convocatoria::all();
        $pdf = Pdf::loadView('admin.procesos.pdf', compact('convocatorias'));
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
        $tipo_programa= TipoPrograma::all();
        $proceso_admision = ProcesoAdmision::all();
        return view('admin.procesos.edit', compact('convocatoria','tipo_programa','proceso_admision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'anio' => 'required',
            'numero' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'fecha_inicio_carga' => 'required',
            'fecha_fin_carga' => 'required',
            'tipo_programa_id' => 'required',
            'proceso_admision_id' => 'required',
            'tipo_programa_id' => 'required',
            'proceso_admision_id' => 'required',

        ]);
        $input = $request->all();
        $convocatoria = Convocatoria::find($id);
        $convocatoria->update($input);
        return redirect()->route('admin.procesos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Convocatoria::find($id)->delete();
        return redirect()->route('admin.procesos.index')->with('eliminar', 'ok');
    }
}
