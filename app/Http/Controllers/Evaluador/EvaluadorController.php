<?php

namespace App\Http\Controllers\Evaluador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Postulante;
use App\Models\Puntaje;
use App\Models\Preinscripcion;
use App\Models\Convocatoria;
use App\Models\PorcentajeNota;
use App\Models\InfAcademica;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

use RealRashid\SweetAlert\Facades\Alert;


class EvaluadorController extends Controller
{
    use WithPagination;

    public function index(Request $request)
    {
        $search = $request->input('search');
        /*$postulantes = Preinscripcion::where('nombres', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('celular', 'LIKE', '%' . $search . '%')
            ->orWhere('numero_documento', 'LIKE', '%' . $search . '%')
            ->paginate(10);
        */

        $evaluador = Auth::user()->evaluador;
        $mencionEvaluador = $evaluador->mencion;
        $ultimaConvocatoria = Convocatoria::latest()->first();
        // Consulta para obtener todos los postulantes que tienen la misma mención que la evaluador y que hayan terminado la inscripcion
        $query = User::role('Postulante')
            ->whereHas('preinscripcion', function ($query) use ($mencionEvaluador, $ultimaConvocatoria) {
                $query->where('mencion_id', $mencionEvaluador->id);
                $query->where('convocatoria_id', $ultimaConvocatoria->id);
            })
            ->whereHas('preinscripcion.postulantes', function ($query) {
                $query->where('current_step', '>=', 7);
            })
            ->with(['preinscripcion.postulantes.puntajes' => function ($query) {
                // Aquí puedes definir restricciones adicionales para la relación puntajes si es necesario
            }]);

        // Aplicar la búsqueda si hay un término de búsqueda
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('nombres', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('numero_documento', 'like', "%$search%");
                // Agrega aquí otros campos que desees buscar en la tabla 'users'
            });
        }

        // Obtener los resultados paginados para mostrarlos en la vista
        $postulantes = $query->paginate(10);
        //dd($postulantes);

        /*$preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        $currentStep = $postulante->current_step;*/

        return view('evaluador.index', compact('postulantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editExpediente(string $id)
    {
        //$postulante = Postulante::find($id);
        $preinscripcion = Preinscripcion::where('user_id', $id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        //dd($id);
        $nombres = User::find($id);
        $studyType = $postulante->Preinscripcion->Mencion->Programa->TipoPrograma->id;
        return view('evaluador.editExpediente', compact('postulante', 'nombres','studyType'));
    }

    public function editEntrevista(string $id)
    {
        //$postulante = Postulante::find($id);
        $preinscripcion = Preinscripcion::where('user_id', $id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        //dd($id);
        $nombres = User::find($id);
        $studyType = $postulante->Preinscripcion->Mencion->Programa->TipoPrograma->id;
        return view('evaluador.editEntrevista', compact('postulante', 'nombres','studyType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nota_cv' => 'required',
            'nota_proyecto' => 'required',
            'nota_crrn' => 'required',
            'nota_formacion' => 'required',
            'nota_idioma' => 'required',
            'nota_investigacion' => 'required',
            'nota_habilidades' => 'required',
        ]);
        dd($id);
        $preinscripcion = Preinscripcion::where('user_id', $id)->latest()->first();

        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

        $puntaje = Puntaje::where('postulante_id', $postulante->id)->latest()->first();

        if ($puntaje) {
            $puntaje->update([
                'nota_cv' => $request->input('nota_cv'),
                'nota_proyecto' => $request->input('nota_proyecto'),
                'nota_crrn' => $request->input('nota_crrn'),
                'nota_formacion' => $request->input('nota_formacion'),
                'nota_idioma' => $request->input('nota_idioma'),
                'nota_investigacion' => $request->input('nota_investigacion'),
                'nota_habilidades' => $request->input('nota_habilidades')
            ]);
            // Calcular la nota total
            $puntaje->nota_total = $puntaje->nota_cv*0.4 + $puntaje->nota_proyecto*0.1 + $puntaje->nota_crrn*0.05 + $puntaje->nota_formacion*0.1 + $puntaje->nota_idioma*0.05 + $puntaje->nota_investigacion*0.2 + $puntaje->nota_habilidades*0.1;
            $puntaje->save();
        }

        //dd($selectedRole);
        $tipoPrograma = '';
        if ($tipoPrograma == 'maestria') {

        } elseif ($tipoPrograma == 'doctorado') {

        }else{

        }

        Alert::success('!Éxito', 'Se ha subido las notas');
        return redirect()->route('evaluador.index' );
    }


    public function destroy(string $id)
    {
        //
    }

    public function report()
    {
        $postulantes = Postulante::all();

        $image = '/img/logob_m_EPG.png';

        $pdf = Pdf::loadView('evaluador.reporte', compact('postulantes', 'image'));

        return $pdf->stream('postulantes_report.pdf');
    }

    public function calificar(Request $request,string $id){
        $request->validate([
            'nota_cv' => 'required',
            'nota_proyecto' => 'required',
            'nota_crrn' => 'required',
            'nota_formacion' => 'required',
            'nota_idioma' => 'required',
            'nota_investigacion' => 'required',
            'nota_habilidades' => 'required',
        ]);

        $puntaje = Puntaje::where('postulante_id', $id)->latest()->first();

        if ($puntaje) {
            $puntaje->update([
                'nota_cv' => $request->input('nota_cv'),
                'nota_proyecto' => $request->input('nota_proyecto'),
                'nota_crrn' => $request->input('nota_crrn'),
                'nota_formacion' => $request->input('nota_formacion'),
                'nota_idioma' => $request->input('nota_idioma'),
                'nota_investigacion' => $request->input('nota_investigacion'),
                'nota_habilidades' => $request->input('nota_habilidades')
            ]);

            // Calcular la nota total
            $puntaje->nota_total = $puntaje->nota_cv*0.4 + $puntaje->nota_proyecto*0.1 + $puntaje->nota_crrn*0.05 + $puntaje->nota_formacion*0.1 + $puntaje->nota_idioma*0.05 + $puntaje->nota_investigacion*0.2 + $puntaje->nota_habilidades*0.1;
            $puntaje->save();
        }

        //dd($selectedRole);
        $tipoPrograma = '';
        if ($tipoPrograma == 'maestria') {

        } elseif ($tipoPrograma == 'doctorado') {

        }else{

        }

        Alert::success('!Éxito', 'Se ha subido las notas');
        return redirect()->route('evaluador.index' );
    }

    public function calificarExpediente(Request $request, $id){
        $ultimaConvocatotria = Convocatoria::latest()->first();
        $postulante = Postulante::find($id);
        $studyType = $postulante->Preinscripcion->Mencion->Programa->TipoPrograma->id;

        if($studyType==1){
            $porcentajeNotas = PorcentajeNota::where('tipo_programa_id', 1)
                                ->where('convocatoria_id', $ultimaConvocatotria->id)->latest()->first();
            $request->validate([
                'nota_cv' =>'required',
                'nota_proyecto' => 'required'
            ]);
            //dd($postulante->Preinscripcion);
            if($postulante->puntajes->isEmpty()){
                $puntaje = new Puntaje();
                $puntaje->postulante_id = $postulante->id;
                $puntaje->porcentaje_nota_id = $porcentajeNotas->id;
                $puntaje->nota_cv = $request->nota_cv;
                $puntaje->nota_proyecto = $request->nota_proyecto;
                $puntaje->nota_parcial1 = $porcentajeNotas->nota_1/100 * $request->nota_cv + $porcentajeNotas->nota_2/100 * $request->nota_proyecto;
                $puntaje->save();
                //dd($puntaje->nota_parcial1);
            }else{
                //$puntaje = Puntaje::where('postulante_id', $postulante->id);
                $puntaje = Puntaje::firstOrNew(['postulante_id' => $postulante->id]);

                $puntaje->postulante_id = $postulante->id;
                $puntaje->porcentaje_nota_id = $porcentajeNotas->id;
                $puntaje->nota_cv = $request->nota_cv;
                $puntaje->nota_proyecto = $request->nota_proyecto;
                $puntaje->nota_parcial1 = $porcentajeNotas->nota_1/100 * $request->nota_cv + $porcentajeNotas->nota_2/100 * $request->nota_proyecto;
                $puntaje->save();
                //dd($puntaje->nota_parcial1);
            }

        }elseif(studyType==2){
            $porcentajeNotas = PorcentajeNota::where('tipo_programa_id', 2)
                                ->where('convocatoria_id', $ultimaConvocatotria->id)->latest()->first();
            $request->validate([
                'nota_cv' =>'required',
                'nota_proyecto' => 'required',
                'docencia' => 'required'
            ]);
            //dd($postulante->Preinscripcion);
            if($postulante->puntajes->isEmpty()){
                $puntaje = new Puntaje();
                $puntaje->postulante_id = $postulante->id;
                $puntaje->porcentaje_nota_id = $porcentajeNotas->id;
                $puntaje->nota_cv = $request->nota_cv;
                $puntaje->nota_proyecto = $request->nota_proyecto;
                $puntaje->nota_crrn = $request->docencia;
                $puntaje->nota_parcial1 = ($porcentajeNotas->nota_1/100 * $request->nota_cv) + ($porcentajeNotas->nota_2/100 * $request->nota_proyecto)
                + ($porcentajeNotas->nota_3/100 * $request->docencia);
                $puntaje->save();
                //dd($puntaje->nota_parcial1);
            }else{
                //$puntaje = Puntaje::where('postulante_id', $postulante->id);
                $puntaje = Puntaje::firstOrNew(['postulante_id' => $postulante->id]);

                $puntaje->postulante_id = $postulante->id;
                $puntaje->porcentaje_nota_id = $porcentajeNotas->id;
                $puntaje->nota_cv = $request->nota_cv;
                $puntaje->nota_proyecto = $request->nota_proyecto;
                $puntaje->nota_crrn = $request->docencia;
                $puntaje->nota_parcial1 = ($porcentajeNotas->nota_1/100 * $request->nota_cv) + ($porcentajeNotas->nota_2/100 * $request->nota_proyecto)
                + ($porcentajeNotas->nota_3/100 * $request->docencia);
                $puntaje->save();
                //dd($puntaje->nota_parcial1);
            }
        }else{
            dd('no coincide');
        }
        Alert::success('!Éxito', 'Se ha subido las notas');
        return redirect()->route('evaluador.index' );
    }

    public function calificarEntrevista(Request $request, $id){
        $ultimaConvocatotria = Convocatoria::latest()->first();
        $postulante = Postulante::find($id);
        $studyType = $postulante->Preinscripcion->Mencion->Programa->TipoPrograma->id;
        $puntaje = Puntaje::where('postulante_id', $postulante->id)->first();

        if($studyType==1){
            $porcentajeNotas = PorcentajeNota::where('tipo_programa_id', 1)
                                ->where('convocatoria_id', $ultimaConvocatotria->id)->latest()->first();
            $request->validate([
                'nota_crrn' =>'required',
                'nota_formacion' => 'required',
                'nota_idioma' => 'required',
                'nota_investigacion' => 'required',
                'nota_habilidades' => 'required'
            ]);
            //dd($postulante->Preinscripcion);
                $puntaje->porcentaje_nota_id = $porcentajeNotas->id;
                $puntaje->nota_crrn = $request->nota_crrn;
                $puntaje->nota_formacion = $request->nota_formacion;
                $puntaje->nota_idioma = $request->nota_idioma;
                $puntaje->nota_investigacion = $request->nota_investigacion;
                $puntaje->nota_habilidades = $request->nota_habilidades;
                $puntaje->nota_parcial2 = ($porcentajeNotas->nota_3/100 * $request->nota_crrn) + ($porcentajeNotas->nota_4/100 * $request->nota_formacion)
                + ($porcentajeNotas->nota_5/100 * $request->nota_idioma) + ($porcentajeNotas->nota_6/100 * $request->nota_investigacion)
                + ($porcentajeNotas->nota_7/100 * $request->nota_habilidades);
                $puntaje->nota_total = $puntaje->nota_parcial1 + $puntaje->nota_parcial2;
                $puntaje->save();
                //dd($puntaje->nota_parcial1);


        }elseif(studyType==2){
            $porcentajeNotas = PorcentajeNota::where('tipo_programa_id', 2)
                                ->where('convocatoria_id', $ultimaConvocatotria->id)->latest()->first();
            $request->validate([
                'nota_formacion' => 'required',
                'nota_idioma' => 'required',
                'nota_investigacion' => 'required',
                'nota_habilidades' => 'required'
            ]);
            //dd($postulante->Preinscripcion);
                $puntaje->porcentaje_nota_id = $porcentajeNotas->id;
                $puntaje->nota_crrn = $request->nota_crrn;
                $puntaje->nota_formacion = $request->nota_formacion;
                $puntaje->nota_idioma = $request->nota_idioma;
                $puntaje->nota_investigacion = $request->nota_investigacion;
                $puntaje->nota_habilidades = $request->nota_habilidades;
                $puntaje->nota_parcial2 = ($porcentajeNotas->nota_4/100 * $request->nota_formacion) + ($porcentajeNotas->nota_5/100 * $request->nota_idioma)
                + ($porcentajeNotas->nota_6/100 * $request->nota_investigacion) + ($porcentajeNotas->nota_7/100 * $request->nota_habilidades);
                $puntaje->nota_total = $puntaje->nota_parcial1 + $puntaje->nota_parcial2;
                $puntaje->save();
                //dd($puntaje->nota_parcial1);
        }else{
            dd('este tipo de programa no esta desarrollado');
        }
        Alert::success('!Éxito', 'Se ha subido las notas');
        return redirect()->route('evaluador.index' );
    }

    public function fichaInscripcion($id)
    {
        $postulante = Postulante::find($id);
        // Define la ubicación del archivo PDF en el almacenamiento
        $pdfPath = storage_path("app/public/{$postulante->id}/inscripcion.pdf");

        // Verifica si el archivo existe
        if (Storage::exists("public/{$postulante->id}/inscripcion.pdf")) {
            // Devuelve el archivo PDF como respuesta
            return Response::file($pdfPath);
        }

        // Si el archivo no existe, puedes manejarlo como desees, por ejemplo, mostrando un mensaje de error o redireccionando a una página de error.
        // Por ejemplo, puedes lanzar una excepción:
        throw new \Exception("El archivo PDF no existe para el ID proporcionado.");
    }
    public function proyectoInvest($id)
    {
        $postulante = Postulante::find($id);
        // Define la ubicación del archivo PDF en el almacenamiento
        $pdfPath = storage_path("app/public/{$postulante->id}/ProyectoInvestigacion.pdf");

        // Verifica si el archivo existe
        if (Storage::exists("public/{$postulante->id}/ProyectoInvestigacion.pdf")) {
            // Devuelve el archivo PDF como respuesta
            return Response::file($pdfPath);
        }

        // Si el archivo no existe, puedes manejarlo como desees, por ejemplo, mostrando un mensaje de error o redireccionando a una página de error.
        // Por ejemplo, puedes lanzar una excepción:
        throw new \Exception("El archivo PDF no existe para el ID proporcionado.");
    }
    public function CV($id)
    {
        $postulante = Postulante::find($id);
        // Define la ubicación del archivo PDF en el almacenamiento
        $pdfPath = storage_path("app/public/{$postulante->id}/CV.pdf");

        // Verifica si el archivo existe
        if (Storage::exists("public/{$postulante->id}/CV.pdf")) {
            // Devuelve el archivo PDF como respuesta
            return Response::file($pdfPath);
        }

        // Si el archivo no existe, puedes manejarlo como desees, por ejemplo, mostrando un mensaje de error o redireccionando a una página de error.
        // Por ejemplo, puedes lanzar una excepción:
        throw new \Exception("El archivo PDF no existe para el ID proporcionado.");
    }
    public function GradoAcademico($id)
    {
        $postulante = Postulante::find($id);
        // Define la ubicación del archivo PDF en el almacenamiento
        $pdfPath = storage_path("app/public/{$postulante->id}/GradoAcademico.pdf");

        // Verifica si el archivo existe
        if (Storage::exists("public/{$postulante->id}/GradoAcademico.pdf")) {
            // Devuelve el archivo PDF como respuesta
            return Response::file($pdfPath);
        }

        // Si el archivo no existe, puedes manejarlo como desees, por ejemplo, mostrando un mensaje de error o redireccionando a una página de error.
        // Por ejemplo, puedes lanzar una excepción:
        throw new \Exception("El archivo PDF no existe para el ID proporcionado.");
    }

}
