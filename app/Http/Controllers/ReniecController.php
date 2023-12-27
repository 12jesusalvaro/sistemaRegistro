<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\Postulante;
use App\Models\Puntaje;
use App\Models\PorcentajeNota;
use App\Models\Preinscripcion;
use App\Models\TipoPrograma;
use App\Models\Mencion;
use App\Models\Programa;
use App\Models\TipoDocumento;
use App\Models\EstadoCivil;
use App\Models\Pais;
use App\Models\Nacionalidad;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\DatosGeneral;
use App\Models\ExpProfesional;
use App\Models\InfAcademica;
use App\Models\IdiomaRealizada;
use App\Models\Convocatoria;

use App\Http\Controllers\PdfController;

use App\Models\ProdCientifica;
use App\Models\TipoUniversidad;
use App\Models\EscalaValorativa;
use App\Models\Idioma;


class ReniecController extends Controller
{
    public function DatosReniec(Request $request)
    {
        //$dni = $request->user()->dni;
        //$result = DB::table('postulantes')->select('*')->where('numero_documento', $dni)->first();
        /*$datos = [
            "dni" => $dni,
            "nombres" => $result->nombres,
            "apellido_paterno" => $result->apellido_paterno,
            "apellido_materno" => $result->apellido_materno,
            "email" => $result->correo_electronico
        ];*/
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();

        $ultimaConvocatoria = Convocatoria::latest()->first();

        /*$exists = Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)
                                   ->where('user_id', $request->user()->id)
                                   ->exists();*/

        /* Function to validate an postulante is registered in preinscripcions and estadoPago = 1*/
        $exists = Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)
                    ->where('user_id', $request->user()->id)
                    ->whereHas('pagoInscripcion', function ($query) {
                        $query->where('estado_pago', 1);
                    })
                    ->exists();

        //if($preinscripcion==NULL && $exists == FALSE){
        if(!$exists){
            return redirect()->route('preinscripcion.index');
        }

        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        $currentStep = $postulante->current_step;
        $studyType = $postulante->Preinscripcion->Mencion->Programa->TipoPrograma->id;
        //obtener la mencion
        $idMencion = $preinscripcion->mencion_id;
        //$studyType = 2;
        //$studyType = Postulante::with('preinscripcion.mencion.programa.tipoDePrograma')->find($id);
       //$studyType=Postulante::join('preinscripcions', 'preinscripcions.user_id', '=', 'users.id');

        $result = User::join('preinscripcions', 'preinscripcions.user_id', '=', 'users.id')
             ->join('postulantes', 'postulantes.preinscripcion_id', '=', 'preinscripcions.id')
             ->where('postulantes.id', $postulante->id)
             ->select('users.*')
             ->first();
        $tipoDocumento = TipoDocumento::find($result->tipo_documento_id);
        //buscar la mencion mediante el id
        $mencion = Mencion::find($idMencion);

        //obternet el programa
        $idPrograma=$mencion->programa_id;
        $programa= Programa::find($idPrograma);
        //$nombreMencion = $mencion->nombre;

        $datos = [
            "numero_documento" => $result->numero_documento,
                "nombres" => $result->nombres,
                "cant_apellidos" => $result->cant_apellidos,
                "primer_apellido" => $result->primer_apellido,
                "segundo_apellido" => $result->segundo_apellido,
                "tipo_documento" => $tipoDocumento->nombre,
                "email" => $request->user()->email,
                "numero_celular" => $result->celular,
                "mencion"=>$mencion->nombre,
                "programa"=>$programa->nombre,
        ];
        $estadoCivils = EstadoCivil::all();
        $paises = Pais::all();
        $nacionalidades = Nacionalidad::all();
        $departamentos = Departamento::all();
        $tipoUniversidades = TipoUniversidad::all();
        $escalaValorativas = EscalaValorativa::all();
        $idiomas = Idioma::all();

        return view('formulario', compact('currentStep', 'datos','estadoCivils',
        'paises', 'nacionalidades', 'departamentos','studyType',
        'tipoUniversidades','escalaValorativas','idiomas', 'exists'));
    }

    //function to get provincias by departments
    public function getProvinciasByDepartamento(Request $request)
    {
        $departamentoId = $request->input('departamento_id');
        $provincias = Provincia::where('departamento_id', $departamentoId)->get();

        return response()->json($provincias);
    }

    //function to get distritos by provincias
    public function getDistritosByProvincia(Request $request)
    {
        $provinciaId = $request->input('provincia_id');
        $distritos = Distrito::where('provincia_id', $provinciaId)->get();

        return response()->json($distritos);
    }

    //function to save datos general of postulantes
    public function guardarDatosGenerales(Request $request)
    {
        $currentStep = 2;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->save();
        }
        // Redirigir a la vista
        return redirect()->route('formulario', ['step' => $currentStep]);
    }

    //function to save datos general of postulantes
    public function guardarDatos(Request $request)
    {
        $request->validate([
            'fecha_nacimiento' => ['required', 'date'],
            'pais_nac_id' => ['required', 'integer'],
            'nacionalidad_id' => ['required', 'integer'],
            'departamento_nac_id' => [''],
            'provincia_nac_id' => [''],
            'distrito_nac_id' => [''],
            'direccion_domiciliaria' => ['required', 'string', 'max:255'],
            'distrito_domic_id' => ['required', 'integer'],
            'edad' => ['required', 'integer'],
            'sexo' => ['required'],
            'ubigeo_domicilio' => ['required'],
            'ubigeo_nacimiento' => ['required'],
            'estado_civil_id' => ['required', 'integer'],
            'discapacidad_id' => [''],
        ]);
        $datosGeneral = new DatosGeneral();
        $datosGeneral->fecha_nacimiento = $request->fecha_nacimiento;
        $datosGeneral->sexo = $request->sexo;
        $datosGeneral->pais_nac_id = $request->pais_nac_id;
        $datosGeneral->nacionalidad_id = $request->nacionalidad_id;
        $datosGeneral->distrito_nac_id = $request->distrito_domic_id;
        $datosGeneral->direccion_domiciliaria = $request->direccion_domiciliaria;
        $datosGeneral->ubigeo_domicilio = $request->ubigeo_domicilio;
        $datosGeneral->ubigeo_nacimiento = $request->ubigeo_nacimiento;
        $datosGeneral->distrito_domic_id = $request->distrito_domic_id;
        $datosGeneral->edad = $request->edad;
        $datosGeneral->estado_civil_id = $request->estado_civil_id;
        $datosGeneral->discapacidad_id = $request->discapacidad_id;


        //$datosGeneral = new DatosGeneral();
        //$datosGeneral->fill($datos);
        $datosGeneral->save();

        //$ultimaConvocatoria = Convocatoria::latest()->first();
        // Obtener el ID de datos_general
        $datosGeneralId = $datosGeneral->id;

        $currentStep = 2;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        /*$postulante = new Postulante();
        $postulante->preinscripcion()->associate($preinscripcion);
        $postulante->convocatoria_id = $ultimaConvocatoria->id;*/
        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->datos_general_id = $datosGeneralId;
            $postulante->save();
        }
        return redirect()->route('formulario', ['step' => $currentStep])->withErrors($request->session()->get('errors'));
    }

    public function guardarInformacionAcademica(Request $request){

        $request->validate([
            'universidad_pre' => ['required'],
            'tipo_universidad' => ['required'],
            'anio_ingreso_pre' => ['required', 'integer'],
            'anio_egreso_pre' => ['required', 'integer'],
            'pais_pre' => ['required'],
            'distrito_domic_id' => ['required'],
            'grado' => ['required', 'string', 'max:255'],
            'est_concluidos' => ['required'],
        ]);
        //hallar el id del postulante
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

        $infAcademica = new InfAcademica();
        $infAcademica->nombre_universidad = $request->universidad_pre;
        $infAcademica->tipo_universidad_id = $request->tipo_universidad;
        $infAcademica->anio_ingreso = $request->anio_ingreso_pre;
        $infAcademica->anio_egreso = $request->anio_egreso_pre;
        $infAcademica->pais_id = $request->pais_pre;
        $infAcademica->distrito_estudio_id = $request->distrito_domic_id;
        $infAcademica->postulante_id = $postulante->id;
        $infAcademica->grado_obtenido = $request->grado;
        $infAcademica->est_concluidos = $request->est_concluidos;

        $infAcademica->save();

        $fields = ['otra_universidad', 'anio_ingreso_otro', 'anio_egreso_otro', 'distrito_domic_id', 'grado_otro', 'est_concluidos_otro'];
        //$fields = ['universidad_pre', 'tipo_universidad', 'anio_ingreso_pre', 'anio_egreso_pre', 'pais_pre', 'distrito_domic_id', 'grado', 'est_concluidos'];
        $hasValue = $request->input('otra_universidad');

        if (isset($hasValue)) {
            $request->validate([
                'otra_universidad' => ['required'],
                'tipo_universidad_otra' => ['required'],
                'anio_ingreso_otro' => ['required', 'integer'],
                'anio_egreso_otro' => ['required', 'integer'],
                'pais_otro' => ['required'],
                'distrito_domic_id' => [''],
                'grado_otro' => ['required', 'string', 'max:255'],
                'est_concluidos_otro' => ['required'],
            ]);
            //hallar el id del postulante
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
            $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

            $infAcademica = new InfAcademica();
            $infAcademica->nombre_universidad = $request->otra_universidad;
            $infAcademica->tipo_universidad_id = $request->tipo_universidad_otra;
            $infAcademica->anio_ingreso = $request->anio_ingreso_otro;
            $infAcademica->anio_egreso = $request->anio_egreso_otro;
            $infAcademica->pais_id = $request->pais_otro;
            $infAcademica->distrito_estudio_id = $request->distrito_domic_id;
            $infAcademica->postulante_id = $postulante->id;
            $infAcademica->grado_obtenido = $request->grado_otro;
            $infAcademica->est_concluidos = $request->est_concluidos_otro;

            $infAcademica->save();
        } else {
            // Todos los campos están vacíos o no están definidos
        }


        $currentStep = 3;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->save();
        }
        return redirect()->route('formulario', ['step' => $currentStep])->withErrors($request->session()->get('errors'));
    }

    public function guardarInformacionAcademica2(Request $request){

        $request->validate([
            'universidad_pos' => ['required'],
            'anio_ingreso_pos' => ['required'],
            'anio_ingreso_pre' => ['required', 'integer'],
            'anio_egreso_pre' => ['required', 'integer'],
            'pais_pre' => ['required'],
            'distrito_domic_id' => ['required'],
            'grado' => ['required', 'string', 'max:255'],
            'est_concluidos' => ['required'],
        ]);
        //hallar el id del postulante
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

        $infAcademica = new InfAcademica();
        $infAcademica->nombre_universidad = $request->universidad_pre;
        $infAcademica->tipo_universidad_id = $request->tipo_universidad;
        $infAcademica->anio_ingreso = $request->anio_ingreso_pre;
        $infAcademica->anio_egreso = $request->anio_egreso_pre;
        $infAcademica->pais_id = $request->pais_pre;
        $infAcademica->distrito_estudio_id = $request->distrito_domic_id;
        $infAcademica->postulante_id = $postulante->id;
        $infAcademica->grado_obtenido = $request->grado;
        $infAcademica->est_concluidos = $request->est_concluidos;

        $infAcademica->save();

        $fields = ['otra_universidad', 'anio_ingreso_otro', 'anio_egreso_otro', 'distrito_domic_id', 'grado_otro', 'est_concluidos_otro'];
        //$fields = ['universidad_pre', 'tipo_universidad', 'anio_ingreso_pre', 'anio_egreso_pre', 'pais_pre', 'distrito_domic_id', 'grado', 'est_concluidos'];
        $hasValue = $request->input('otra_universidad');

        if (isset($hasValue)) {
            $request->validate([
                'otra_universidad' => ['required'],
                'tipo_universidad_otra' => ['required'],
                'anio_ingreso_otro' => ['required', 'integer'],
                'anio_egreso_otro' => ['required', 'integer'],
                'pais_otro' => ['required'],
                'distrito_domic_id' => [''],
                'grado_otro' => ['required', 'string', 'max:255'],
                'est_concluidos_otro' => ['required'],
            ]);
            //hallar el id del postulante
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
            $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

            $infAcademica = new InfAcademica();
            $infAcademica->nombre_universidad = $request->otra_universidad;
            $infAcademica->tipo_universidad_id = $request->tipo_universidad_otra;
            $infAcademica->anio_ingreso = $request->anio_ingreso_otro;
            $infAcademica->anio_egreso = $request->anio_egreso_otro;
            $infAcademica->pais_id = $request->pais_otro;
            $infAcademica->distrito_estudio_id = $request->distrito_domic_id;
            $infAcademica->postulante_id = $postulante->id;
            $infAcademica->grado_obtenido = $request->grado_otro;
            $infAcademica->est_concluidos = $request->est_concluidos_otro;

            $infAcademica->save();
        } else {
            // Todos los campos están vacíos o no están definidos
        }


        $currentStep = 3;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->save();
        }
        return redirect()->route('formulario', ['step' => $currentStep])->withErrors($request->session()->get('errors'));
    }


    public function guardarExperienciaProfecional(Request $request){
        // Validar y guardar la experiencia laboral en la base de datos o en otra ubicación
        // ...
        $request->validate([
            'inst_procedencia' => ['required', 'string', 'max:255'],
            'carg_actual' => ['required', 'string', 'max:255'],
            'fecha_inicio' => ['required', 'date'],
            'otros' => [''],
            'codigo_otro_inscripcion' => ['required'],
            'cod_orcid' => ['required', 'string', 'max:255'],

        ]);

        $experienciaProfesional= new ExpProfesional();
        $experienciaProfesional->inst_procedencia=$request->inst_procedencia;
        $experienciaProfesional->carg_actual=$request->carg_actual;
        $experienciaProfesional->fecha_inicio=$request->fecha_inicio;
        $experienciaProfesional->otros=$request->otros;
        $experienciaProfesional->codigo_otro_inscripcion=$request->codigo_otro_inscripcion;
        $experienciaProfesional->cod_orcid=$request->cod_orcid;

        $experienciaProfesional->save();

        // Obtener el ID de exp_profesional
        $experienciaProfesionalId = $experienciaProfesional->id;
        // Actualizar el paso actual
        $currentStep = 4;

        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        //$postulante = Postulante::where('id', $request->user()->postulante_id)->first();
        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->exp_profesional_id = $experienciaProfesionalId;
            $postulante->save();
        }

        return redirect()->route('formulario', ['step' => $currentStep]);
    }

    public function guardarProduccionCientifica(Request $request){
        // Validar y guardar la produccion cientifica
            // ...
            $request->validate([
                'trabajo_01' => ['required', 'string', 'max:120'],
                'revista_01' => ['required', 'string', 'max:120'],
                'año_pub_01' => ['required', 'integer'],
                'numero_pub_01' => ['required', 'integer'],
                'volumen_pub_01' => ['required', 'string', 'max:50'],
                'paginas_pub_01' => ['required', 'integer'],
                'a_pub_01' => ['required', 'integer'],

            ]);

            $produccionCientifica= new ProdCientifica();
            $produccionCientifica->titulo = $request->trabajo_01;
            $produccionCientifica->nombre = $request->revista_01;
            $produccionCientifica->anio = $request->año_pub_01;
            $produccionCientifica->numero = $request->numero_pub_01;
            $produccionCientifica->volumen = $request->volumen_pub_01;
            $produccionCientifica->paginas = $request->paginas_pub_01;
            $produccionCientifica->hasta_pag = $request->a_pub_01;
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
            $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
            // Obtener el ID de postulante
            $postulanteId = $postulante->id;
            $produccionCientifica->postulante_id = $postulanteId;
            $produccionCientifica->save();

        $HayDato2 = $request->input('trabajo_02');

        if (isset($HayDato2)) {
            $request->validate([
                'trabajo_02' => ['required', 'string', 'max:120'],
                'revista_02' => ['required', 'string', 'max:120'],
                'año_pub_02' => ['required', 'integer'],
                'numero_pub_02' => ['required', 'integer'],
                'volumen_pub_02' => ['required', 'string', 'max:50'],
                'paginas_pub_02' => ['required', 'integer'],
                'a_pub_02' => ['required', 'integer'],
            ]);
            //hallar el id del postulante
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
            $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

            $produccionCientifica = new ProdCientifica();
            $produccionCientifica->titulo = $request->trabajo_02;
            $produccionCientifica->nombre = $request->revista_02;
            $produccionCientifica->anio = $request->año_pub_02;
            $produccionCientifica->numero = $request->numero_pub_02;
            $produccionCientifica->volumen = $request->volumen_pub_02;
            $produccionCientifica->paginas = $request->paginas_pub_02;
            $produccionCientifica->hasta_pag = $request->a_pub_02;
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
            $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
            // Obtener el ID de postulante
            $postulanteId = $postulante->id;
            $produccionCientifica->postulante_id = $postulanteId;

            $produccionCientifica->save();
        } else {
            // Todos los campos están vacíos o no están definidos
        }

        $HayDato3 = $request->input('trabajo_03');

        if (isset($HayDato3)) {
            $request->validate([
                'trabajo_03' => ['required', 'string', 'max:120'],
                'revista_03' => ['required', 'string', 'max:120'],
                'año_pub_03' => ['required', 'integer'],
                'numero_pub_03' => ['required', 'integer'],
                'volumen_pub_03' => ['required', 'string', 'max:50'],
                'paginas_pub_03' => ['required', 'integer'],
                'a_pub_03' => ['required', 'integer'],
            ]);

            //hallar el id del postulante
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
            $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

            $produccionCientifica= new ProdCientifica();
            $produccionCientifica->titulo = $request->trabajo_03;
            $produccionCientifica->nombre = $request->revista_03;
            $produccionCientifica->anio = $request->año_pub_03;
            $produccionCientifica->numero = $request->numero_pub_03;
            $produccionCientifica->volumen = $request->volumen_pub_03;
            $produccionCientifica->paginas = $request->paginas_pub_03;
            $produccionCientifica->hasta_pag = $request->a_pub_03;
            $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
            $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
            // Obtener el ID de postulante
            $postulanteId = $postulante->id;
            $produccionCientifica->postulante_id = $postulanteId;

            $produccionCientifica->save();
        } else {
            // Todos los campos están vacíos o no están definidos
        }

        $currentStep = 5;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->save();
        }
            return redirect()->route('formulario', ['step' => $currentStep])->withErrors($request->session()->get('errors'));
    }

    public function guardarIdiomas(Request $request)
    {
        $request->validate([
            'idioma_01' => ['required', 'string', 'max:120'],
            'habla_01' => ['required', 'string', 'max:120'],
            'lee_01' => ['required', 'integer'],
            'escribe_01' => ['required', 'integer'],
        ]);

        $idiomaRealizada= new IdiomaRealizada();
        $idiomaRealizada->list_idioma_id = $request->idioma_01;
        $idiomaRealizada->habla_id = $request->habla_01;
        $idiomaRealizada->lee_id = $request->lee_01;
        $idiomaRealizada->escribe_id = $request->escribe_01;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        // Obtener el ID de postulante
        $postulanteId = $postulante->id;
        $idiomaRealizada->postulante_id = $postulanteId;
        $idiomaRealizada->save();

    $HayDato2 = $request->input('idioma_02');

    if (isset($HayDato2)) {
        $request->validate([
            'idioma_02' => ['required', 'string', 'max:120'],
            'habla_02' => ['required', 'string', 'max:120'],
            'lee_02' => ['required', 'integer'],
            'escribe_02' => ['required', 'integer'],
        ]);

        $idiomaRealizada= new IdiomaRealizada();
        $idiomaRealizada->list_idioma_id = $request->idioma_02;
        $idiomaRealizada->habla_id = $request->habla_02;
        $idiomaRealizada->lee_id = $request->lee_02;
        $idiomaRealizada->escribe_id = $request->escribe_02;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        // Obtener el ID de postulante
        $postulanteId = $postulante->id;
        $idiomaRealizada->postulante_id = $postulanteId;
        $idiomaRealizada->save();
    } else {
        // Todos los campos están vacíos o no están definidos
    }

    $HayDato3 = $request->input('idioma_03');

    if (isset($HayDato3)) {
        $request->validate([
            'idioma_03' => ['required', 'string', 'max:120'],
            'habla_03' => ['required', 'string', 'max:120'],
            'lee_03' => ['required', 'integer'],
            'escribe_03' => ['required', 'integer'],
        ]);

        $idiomaRealizada= new IdiomaRealizada();
        $idiomaRealizada->list_idioma_id = $request->idioma_03;
        $idiomaRealizada->habla_id = $request->habla_03;
        $idiomaRealizada->lee_id = $request->lee_03;
        $idiomaRealizada->escribe_id = $request->escribe_03;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        // Obtener el ID de postulante
        $postulanteId = $postulante->id;
        $idiomaRealizada->postulante_id = $postulanteId;
        $idiomaRealizada->save();
    } else {
        // Todos los campos están vacíos o no están definidos
    }

    $currentStep = 6;
    $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
    $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
    if ($postulante) {
        $postulante->current_step = $currentStep;
        $postulante->save();
    }

            return redirect()->route('formulario', ['step' => $currentStep]);
    }

    public function guardarSubirArchivos(Request $request)
    {
        // Validar y guardar los archivos en la base de datos o en otra ubicación
        // ...

        // Finalizar el formulario o realizar cualquier otra acción necesaria
        // ...
        $currentStep = 7;
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        $ultimaConvocatotria = Convocatoria::latest()->first();

        if ($postulante) {
            $postulante->current_step = $currentStep;
            $postulante->save();
        }

        //generating un register of Puntaje for tipo_programas
        $tipoProgama = $preinscripcion->mencion->programa->tipoPrograma;
        if($tipoProgama->id == 1){
            $porcentajeNotas = PorcentajeNota::where('tipo_programa_id', 1)
                                ->where('convocatoria_id', $ultimaConvocatotria->id)->latest()->first();

            $puntaje = new Puntaje([
                'postulante_id' => $postulante->id,
                'porcentaje_nota_id' => $porcentajeNotas->id
            ]);
            $puntaje->save();
        }elseif($tipoProgama->id == 2){
            $porcentajeNotas = PorcentajeNota::where('tipo_programa_id', 2)
                                ->where('convocatoria_id', $ultimaConvocatotria->id)->latest()->first();

            $puntaje = new Puntaje([
                'postulante_id' => $postulante->id,
                'porcentaje_nota_id' => $porcentajeNotas->id
            ]);
            $puntaje->save();
        }else{

        }
        $pdfController = new PdfController();

         // Llama al método upload en la instancia de PdfController
        $resultado = $pdfController->upload($request);

        return redirect()->route('formulario', ['step' => $currentStep]);
    }

        public function formularioFinalizado()
        {
            return view('formulario.finalizado');
        }
}
