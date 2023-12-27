<?php

namespace App\Http\Controllers\Secretaria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Postulante;
use App\Models\Preinscripcion;
use App\Models\Convocatoria;
use App\Models\TipoPrograma;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\Mencion;
use App\Models\Programa;


class SecretariaController extends Controller
{
    use WithPagination;

    public function index(Request $request)
    {
        $secretaria = Auth::user()->secretaria;
        $mencionSecretaria = $secretaria->mencion;
        $convocatorias = Convocatoria::all();

        return view('secretaria.index', compact('convocatorias'));
    }

    //function to search an specific postulante
    public function search(Request $request){
        $search = $request->input('q');
        $secretaria = Auth::user()->secretaria;
        $mencionSecretaria = $secretaria->mencion;
        $convocatoriaSelected = $request->input('convocatoriaID');

        /*$query = User::role('Postulante')->whereHas('preinscripcion', function ($query) use ($mencionSecretaria, $convocatoriaSelected,$search) {
            $query->where('mencion_id', $mencionSecretaria->id)
            ->where('convocatoria_id', $convocatoriaSelected)
            ->where('nombres', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('numero_documento', 'like', "%$search%")
                ->orWhere('celular', 'like', "%$search%");
        });*/
        $query = User::role('Postulante')->whereHas('preinscripcion', function ($query) use ($mencionSecretaria, $convocatoriaSelected, $search) {
            $query->where('mencion_id', $mencionSecretaria->id)
                ->where('convocatoria_id', $convocatoriaSelected)
                ->where(function ($query) use ($search) {
                    $query->where('nombres', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('numero_documento', 'like', "%$search%")
                        ->orWhere('celular', 'like', "%$search%");
                });
        });

        /*$query = User::role('Postulante')->whereHas('preinscripcion', function ($query) use ($mencionSecretaria, $convocatoriaSelected) {
            $query->where('mencion_id', $mencionSecretaria->id);

            if (!empty($convocatoriaSelected)) {
                $query->where('convocatoria_id', $convocatoriaSelected);
            }
        })->where(function ($query) use ($search) {
            $query->where('nombres', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('numero_documento', 'like', "%$search%")
                ->orWhere('celular', 'like', "%$search%");
        });*/

        $postulantes = $query->paginate(10);
        //dd($convocatoriaSelected);
        return view('partials.tabla-postulantes', compact('postulantes'));
    }


    //function to get postulantes by convocatoria
    public function preinscritosByConvocatoria($convocatoriaId){
        $secretaria = Auth::user()->secretaria;
        $mencionSecretaria = $secretaria->mencion;
        $query = User::role('Postulante')->whereHas('preinscripcion', function ($query) use ($mencionSecretaria) {
            $query->where('mencion_id', $mencionSecretaria->id);
        })->whereHas('preinscripcion.postulantes', function ($query) use ($convocatoriaId) {
            $query->where('current_step', '>=', 1)
            ->where('convocatoria_id', $convocatoriaId);
        });
        //->orderBy('created_at','desc');

        //dd($query);

        $postulantes = $query->paginate(10);

        return view('partials.tabla-postulantes', compact('postulantes'));
    }


    //function to get postulantes by convocatoria
    public function postulantesByConvocatoria($convocatoriaId){

        $secretaria = Auth::user()->secretaria;
        $mencionSecretaria = $secretaria->mencion;
        $query = User::role('Postulante')->whereHas('preinscripcion', function ($query) use ($mencionSecretaria) {
            $query->where('mencion_id', $mencionSecretaria->id);
        })->whereHas('preinscripcion.postulantes', function ($query) use ($convocatoriaId) {
            $query->where('current_step', '>=', 2)
            ->where('convocatoria_id', $convocatoriaId);
        });

        $postulantes = $query->paginate(10);

        return view('partials.tabla-postulantes', compact('postulantes'));
    }

    //function only to show postulantes, those who have initiated the application stage
    public function postulantes(Request $request){

        $convocatorias = Convocatoria::all();

        return view('secretaria.postulantes', compact('convocatorias'));

        //return view('secretaria.postulantes', compact('postulantes','convocatorias'));
    }

    public function obtenerPostulantes(Request $request){
        $convocatoriaId = $request->input('convocatoria_id');
        $secretaria = Auth::user()->secretaria;
        $mencionSecretaria = $secretaria->mencion;

        $query = User::role('Postulante')->whereHas('preinscripcion', function ($query) use ($mencionSecretaria) {
            $query->where('mencion_id', $mencionSecretaria->id);
        })->whereHas('preinscripcion.postulantes', function ($query) use ($convocatoriaId) {
            $query->where('current_step', '>=', 1)
            ->where('convocatoria_id', $convocatoriaId);
        });

        $postulantes = $query->paginate(10);

        return view('secretaria.postulantes', compact('postulantes'));
    }

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
    public function edit(string $id)
    {
        $preinscrito = Preinscripcion::where('user_id',$id)->latest()->first();

        //dd($preinscrito->id);
        $postulante = Postulante::where('preinscripcion_id',$preinscrito->id)->first();
        $user=User::find($id);

        $menciones = Mencion::pluck('nombre', 'id');
        $programas = Programa::all();

        $ultimaConvocatoria = Convocatoria::latest()->first();

        //$preinscripcion = $user->preinscripcion()->latest()->first();
        $userMencion = $user->preinscripcion->mencion_id;
        //dd($userMencion);
        $userPrograma=$user->preinscripcion->mencion->programa_id;


        return view('secretaria.edit', compact('postulante','user','userMencion','userPrograma', 'menciones','programas', 'ultimaConvocatoria'));
    }

    public function validar(string $id)
    {
        $preinscrito = Preinscripcion::where('user_id',$id)->latest()->first();

        //dd($preinscrito->id);
        $postulante = Postulante::where('preinscripcion_id',$preinscrito->id)->first();
        $user=User::find($id);


        return view('secretaria.validar', compact('postulante','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

         $user=User::find($id);
         $userData = [
            'nombres' => strtoupper($request->nombres),
            'celular' => $request->input('celular'),
            'email' => $request->input('email'),
            'cant_apellidos' => $request->input('cant_apellidos'),
            'primer_apellido' => strtoupper($request->primer_apellido),
            'current_step' => $request->input('current_step'),
        ];

        if ($request->input('cant_apellidos') == 2) {
            $userData['segundo_apellido'] = strtoupper($request->segundo_apellido);
        } else {
            $userData['segundo_apellido'] = null;
        }
        $input = $request->all();

        // Actualizar los datos del usuario
        $user->update($userData);

        // Obtén el postulante asociado al usuario
        $preinscrito = Preinscripcion::where('user_id', $id)->latest()->first();

        // Actualiza datos del postulante
        $postulante = Postulante::where('preinscripcion_id', $preinscrito->id)->latest()->first();
        $postulante->current_step = $input['current_step'];
        $postulante->update();

        // Actualiza datos de la preinscripción
        $preinscrito->mencion_id = $input['mencion_id'];
        $preinscrito->mencion->programa_id = $input['programa_estudio_id'];
        $preinscrito->update();

        // Redirige a la página deseada
        return redirect()->route('secretaria.index');


    }


    public function destroy(string $id)
    {
        //
    }

    public function report()
    {
        $postulantes = Postulante::all();

        $image = '/img/logob_m_EPG.png';

        $pdf = Pdf::loadView('secretaria.reporte', compact('postulantes', 'image'));

        return $pdf->stream('postulantes_report.pdf');
    }
}
