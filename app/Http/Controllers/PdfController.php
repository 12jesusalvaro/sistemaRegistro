<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Postulante;
use App\Models\User;
use App\Models\Preinscripcion;
use App\Models\Mencion;

use App\Models\DatosGeneral;
use App\Models\Nacionalidad;
use App\Models\EstadoCivil;

use App\Models\InfAcademica;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\Departamento;

use App\Models\TipoUniversidad;

use App\Models\ExpProfesional;
use App\Models\ProdCientifica;
use App\Models\IdiomaRealizada;
use App\Models\EscalaValorativa;
use App\Models\Idioma;
use App\Models\File;

class PdfController extends Controller
{
    public function obtenerDato(Request $request){
        //$request = new Request;
        $id = $request->user()->id;
        return $id;
    }
    public function PdfDeclaracion(Request $request)
    {

        /*$dni = $request->user()->dni;
        $result = DB::table('postulantes')->select('id')->where('numero_documento', $dni)->first();
        $id = $result->id;

        $postulante = Postulante::find($id);

        $pdf2 = Pdf::loadView('pdf.declaracion',compact('postulante', 'id'));
        //return $pdf->stream();
        return $pdf2->stream('declaracion.pdf');*/

        /*$dni = $request->user()->dni;
        $result = DB::table('postulantes')->select('id')->where('numero_documento', $dni)->first();
        $id = $result->id;

        $postulante = Postulante::find($id);
        //$postulante = postulante;
        $pdf2 = Pdf::loadView('pdf.declaracion', compact('postulante', 'id'));
        return $pdf2->stream();*/

        $id = $request->user()->id;
        $postulante = User::find($id);
        $image1 = '/img/Logo_Epg.jpeg';
        $image2 = '/img/Logo_UNAP.png';
        $pdf = Pdf::loadView('pdf.declaracion', compact('postulante', 'id','image1','image2'));
        return $pdf->stream();

    }
    public function PdfSolicitud(Request $request)
    {
        $id = $request->user()->id;
        $postulante = User::find($id);
        $image1 = '/img/Logo_EPGpdf.jpg';
        $image2 = '/img/Logo_UNAP.png';
        $pdf = Pdf::loadView('pdf.solicitud', compact('postulante', 'id','image1','image2'));
        return $pdf->stream();

    }
    public function PdfCarta(Request $request)
    {
        $id = $request->user()->id;
        $postulante = User::find($id);
        //$preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $idMencion = $preinscripcion->mencion_id;
        $mencion = Mencion::find($idMencion);

        $image1 = '/img/Logo_EPGpdf.jpg';
        $image2 = '/img/Logo_UNAP.png';
        $pdf = Pdf::loadView('pdf.cartacomp', compact('postulante', 'mencion','image1','image2'));
        return $pdf->stream();

    }

    public function PdfInscripcion(Request $request)
    {
        $image1 = '/img/Logo_EPGpdf.jpg';
        $image2 = '/img/Logo_UNAP.png';
        $id = $request->user()->id;
        $usuario = User::find($id);
        //$preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        //DATOS GENERAL
        //datos_general_id
        $idDatosGenerales=$postulante->datos_general_id;
        $datogeneral = DatosGeneral::find($idDatosGenerales);
        //id_nacionalidad
        $idNacionalidad=$datogeneral->nacionalidad_id;
        $nacionalidad=Nacionalidad::find($idNacionalidad);
        //seprar año-mes-dia
        $fechaNacimiento = Carbon::parse($datogeneral->fecha_nacimiento);
        $anio = $fechaNacimiento->year;
        $mes = $fechaNacimiento->month;
        $dia = $fechaNacimiento->day;
        //estado_civil_id
        $idEstado=$datogeneral->estado_civil_id;
        $estadoCivil=EstadoCivil::find($idEstado);

       /* $idMencion = $preinscripcion->mencion_id;
        $mencion = Mencion::find($idMencion);*/

        //LUGAR DE NACIMIENTO
        $Distrito_id=$datogeneral->distrito_nac_id;
        $distrito_nac=Distrito::find($Distrito_id);

        $Provincia_id=$distrito_nac->provincia_id;
        $provincia_nac=Provincia::find($Provincia_id);

        $Departamento_id=$provincia_nac->departamento_id;
        $departamento_nac=Departamento::find($Departamento_id);

        $LugarNac= [
            'distrito_nac' => $distrito_nac->nombre,
            'provincia_nac' => $provincia_nac->nombre,
            'departamento_nac' =>$departamento_nac->nombre,
        ];

        //INFORMACION ACADEMICA
        $infAcademica = InfAcademica::where('postulante_id', $postulante->id)->latest()->first();
        //distri-provincia-departamento
        $idDistrito=$infAcademica->distrito_estudio_id;
        $distrito=Distrito::find($idDistrito);

        $idProvincia=$distrito->provincia_id;
        $provincia=Provincia::find($idProvincia);

        $idDepartamento=$provincia->departamento_id;
        $departamento=Departamento::find($idDepartamento);

        $datoInfoAca[] = [
            'distrito' => $distrito->nombre,
            'provincia' => $provincia->nombre,
            'departamento' =>$departamento->nombre,
        ];

        $idTipoU=$infAcademica->tipo_universidad_id;
        $universidad=TipoUniversidad::find($idTipoU);

        //EXPERENCIA PROFESIONAL
        //datos_general_id
        $idexpProfesional=$postulante->exp_profesional_id;
        $expProfesional = ExpProfesional::find($idexpProfesional);

        //IV PROD CIENTIFICA
        // Realiza la consulta a la base de datos para obtener los datos
        $datosProds = ProdCientifica::all()->where('postulante_id', $postulante->id);

        // Retorna los datos obtenidos en un arreglo compacto para pasarlo a la vista
        //return view('nombre_de_tu_vista')->with(compact('datos'));

        //V. IDIOMAS EXTRANJEROS
        $datosIdioms = IdiomaRealizada::all()->where('postulante_id', $postulante->id);
        //$numeroDeRegistros = $datosIdioms->count();
        //escallaaaa
        //$idEscala=$datosIdioms->estado_civil_id;
        //$estadoCivil=EstadoCivil::find($idEstado);
        $idioms = [];

        foreach ($datosIdioms as $idiom) {
            $escala1 = EscalaValorativa::find($idiom->habla_id);
            $escala2 = EscalaValorativa::find($idiom->lee_id);
            $escala3 = EscalaValorativa::find($idiom->escribe_id);

            $nombre_idioma = Idioma::find($idiom->list_idioma_id);
            $idioms[] = [
                'habla_id' => $escala1->nonbre,
                'lee_id' => $escala2->nonbre,
                'escribe_id' =>$escala3->nonbre,
                'list_idioma_id' => $nombre_idioma->nombre,
            ];
        }
                $pdf = Pdf::loadView('pdf.inscripcion',
        compact('usuario','datogeneral','nacionalidad','estadoCivil','anio','mes'
        ,'dia','infAcademica','LugarNac','datoInfoAca','universidad','expProfesional','datosProds',
        'idioms','image1','image2'));
        return $pdf->stream();
    }

    /*public function upload(Request $request)
    {
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        $postulanteId = $postulante->id;

        $pdfContent = $this->generatePdfContent($request);
        dd('si entra a esta parte del codigo');
        // Crear y guardar el PDF en el almacenamiento público
        $pdfFileName = 'inscripcion.pdf';
        if(PDF::loadHtml($pdfContent)->save(public_path('storage/'.$postulanteId.'/'. $pdfFileName))){
            File::create([
                'name'=>$pdfFileName,
                'postulante_id'=>$postulanteId
            ]);
        }else{
            dd('el error esta aqui');
        }
        //PDF::loadHtml($pdfContent)->save(public_path('storage/'.$postulanteId.'/'. $pdfFileName));
        //public/'.$postulanteId.'/',$file,$file->getClientOriginalName())

    }*/
    public function upload(Request $request)
    {
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        $postulanteId = $postulante->id;

        $pdfContent = $this->generatePdfContent($request);

        // Crear y guardar el PDF en el almacenamiento público
        $pdfFileName = 'inscripcion.pdf';
        if(PDF::loadHtml($pdfContent)->save(public_path('storage/'.$postulanteId.'/'. $pdfFileName))){
            File::create([
                'name'=>$pdfFileName,
                'postulante_id'=>$postulanteId
            ]);
        }
        //PDF::loadHtml($pdfContent)->save(public_path('storage/'.$postulanteId.'/'. $pdfFileName));
        //public/'.$postulanteId.'/',$file,$file->getClientOriginalName())

    }

    private function generatePdfContent(Request $request)
    {
        // Coloca aquí la lógica para generar el contenido HTML del PDF
        // Puedes usar la misma lógica que tienes para generar el PDF en tu vista
        // Asegúrate de retornar el contenido HTML del PDF
        $image1 = '/img/Logo_EPGpdf.jpg';
        $image2 = '/img/Logo_UNAP.png';
        $id = $request->user()->id;
        $usuario = User::find($id);
        //$preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
        //DATOS GENERAL
        //datos_general_id
        $idDatosGenerales=$postulante->datos_general_id;
        $datogeneral = DatosGeneral::find($idDatosGenerales);
        //id_nacionalidad
        $idNacionalidad=$datogeneral->nacionalidad_id;
        $nacionalidad=Nacionalidad::find($idNacionalidad);
        //seprar año-mes-dia
        $fechaNacimiento = Carbon::parse($datogeneral->fecha_nacimiento);
        $anio = $fechaNacimiento->year;
        $mes = $fechaNacimiento->month;
        $dia = $fechaNacimiento->day;
        //estado_civil_id
        $idEstado=$datogeneral->estado_civil_id;
        $estadoCivil=EstadoCivil::find($idEstado);

       /* $idMencion = $preinscripcion->mencion_id;
        $mencion = Mencion::find($idMencion);*/

        //LUGAR DE NACIMIENTO
        $Distrito_id=$datogeneral->distrito_nac_id;
        $distrito_nac=Distrito::find($Distrito_id);

        $Provincia_id=$distrito_nac->provincia_id;
        $provincia_nac=Provincia::find($Provincia_id);

        $Departamento_id=$provincia_nac->departamento_id;
        $departamento_nac=Departamento::find($Departamento_id);

        $LugarNac= [
            'distrito_nac' => $distrito_nac->nombre,
            'provincia_nac' => $provincia_nac->nombre,
            'departamento_nac' =>$departamento_nac->nombre,
        ];

        //INFORMACION ACADEMICA
        $infAcademica = InfAcademica::where('postulante_id', $postulante->id)->latest()->first();
        //distri-provincia-departamento
        $idDistrito=$infAcademica->distrito_estudio_id;
        $distrito=Distrito::find($idDistrito);

        $idProvincia=$distrito->provincia_id;
        $provincia=Provincia::find($idProvincia);

        $idDepartamento=$provincia->departamento_id;
        $departamento=Departamento::find($idDepartamento);

        $datoInfoAca[] = [
            'distrito' => $distrito->nombre,
            'provincia' => $provincia->nombre,
            'departamento' =>$departamento->nombre,
        ];

        $idTipoU=$infAcademica->tipo_universidad_id;
        $universidad=TipoUniversidad::find($idTipoU);

        //EXPERENCIA PROFESIONAL
        //datos_general_id
        $idexpProfesional=$postulante->exp_profesional_id;
        $expProfesional = ExpProfesional::find($idexpProfesional);

        //IV PROD CIENTIFICA
        // Realiza la consulta a la base de datos para obtener los datos
        $datosProds = ProdCientifica::all()->where('postulante_id', $postulante->id);

        // Retorna los datos obtenidos en un arreglo compacto para pasarlo a la vista
        //return view('nombre_de_tu_vista')->with(compact('datos'));

        //V. IDIOMAS EXTRANJEROS
        $datosIdioms = IdiomaRealizada::all()->where('postulante_id', $postulante->id);
        //$numeroDeRegistros = $datosIdioms->count();
        //escallaaaa
        //$idEscala=$datosIdioms->estado_civil_id;
        //$estadoCivil=EstadoCivil::find($idEstado);
        $idioms = [];

        foreach ($datosIdioms as $idiom) {
            $escala1 = EscalaValorativa::find($idiom->habla_id);
            $escala2 = EscalaValorativa::find($idiom->lee_id);
            $escala3 = EscalaValorativa::find($idiom->escribe_id);

            $nombre_idioma = Idioma::find($idiom->list_idioma_id);
            $idioms[] = [
                'habla_id' => $escala1->nonbre,
                'lee_id' => $escala2->nonbre,
                'escribe_id' =>$escala3->nonbre,
                'list_idioma_id' => $nombre_idioma->nombre,
            ];
        }
        $pdfContent = view('pdf.inscripcion',
        compact('usuario','datogeneral','nacionalidad','estadoCivil','anio','mes'
        ,'dia','infAcademica','LugarNac','datoInfoAca','universidad','expProfesional','datosProds',
        'idioms','image1','image2'))->render();

        // Ejemplo: Generar el contenido HTML con las variables
        //$pdfContent = view('pdf.inscripcion', compact('usuario', 'datogeneral', /... Otras variables.../))->render();

        return $pdfContent;
    }

}
