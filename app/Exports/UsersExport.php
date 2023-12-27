<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Postulante;
use App\Models\DatosGeneral;
use App\Models\User;
use App\Models\Preinscripcion;
use App\Models\Convocatoria;
use App\Models\ExpProfesional;
use App\Models\ProcesoAdmision;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        //$preinscripciones = Preinscripcion::all();

        //$postulantes= Postulante::all();
        $ultimaConvocatoria = Convocatoria::latest()->first();
        $postulantes = Postulante::where('convocatoria_id', $ultimaConvocatoria->id)->get();
        // Obtener los usuarios que cumplen con las condiciones
        /*$usuarios = User::all()->whereIn('id', function ($query) {
        $query->select('user_id')->from('preinscripcions');
        })->get();*/
        //$users = $combinedData->concat($preinscripciones);
        //dd($users->pluck('id')->toArray());
        //$usuarios = User::all()->where('postulante_id', $postulante->id);
        //$preinscripcions=[];

        //dd($postulantes);
        $Dat_reporte=[];//variable en la que se guardara todos los datos para el reporte
        foreach($postulantes as $postulante){
            $preinscripcion=Preinscripcion::find($postulante->preinscripcion_id);
            $usuario = User::find($preinscripcion->user_id);
            $datogeneral=DatosGeneral::find($postulante->datos_general_id)->get();
            $convocatoria=Convocatoria::find($preinscripcion->convocatoria_id);
            $exp_profesional=ExpProfesional::find($postulante->exp_profesional_id);
            $proceso_admision=ProcesoAdmision::find($convocatoria->proceso_admision_id);

            dd($datogeneral);
            $Dat_reporte =[
                'sede'=>$proceso_admision->filial_id,
                'tipo_proceso'=>$proceso_admision->tipo_proceso_id,
                'proceso_admision'=>$proceso_admision->nombre,
                'numero_convocatoria'=>$convocatoria->numero,

                'id'=>$preinscripcion->id,
                //'user_id'=>$preinscripcion->user_id,
                'tipo_documento_id' => $usuario->tipo_documento_id,
                'numero_documento' =>$usuario->numero_documento,
                'nombres' => $usuario->nombres,
                'primer_apellido' => $usuario->primer_apellido,
                'segundo_apellido' =>$usuario->segundo_apellido,
                'apellido_casada'=>'',
                'solo_un_apellido' => ($usuario->primer_apellido && !$usuario->segundo_apellido) ? 1 : 0,
                //'sexo' => $datogeneral->sexo,
                'sexo' => 1,
                'fecha_nacimiento'=>$datogeneral->fecha_nacimiento,
                'pais_nac'=>$datogeneral->pais_nac_id,
                'nacionalidad'=>$datogeneral->nacionalidad_id,
                'ubigeo_nac'=>$datogeneral->ubigeo_nacimiento,
                'ubigeo_dom'=>$datogeneral->ubigeo_domicilio,
                'discapacidad'=>($datogeneral->discapacidad_id)? 1:0,//falta el input para saber si tiene o no discapacidad 0 o 1
                'tipo_discapacidad'=>$datogeneral->discapacidad_id,
                'celular' => $usuario->celular,
                'email' => $usuario->email,
                /*'codigo_fdacultad'=>
                'programa'=>
                'fecha_postulacion'=>
                'pntj_obtenido'=>
                'modalidad_admision'=>
                'modalidad_estudio'=>
                'es_ingresante'=>
                'codigo_facultad_ingreso'=>
                'codigo_programa_ingreso'=>
                'fecha_ingreso'=>
                'correo_institucional'=>*/
                'codigo_orcid'=>$exp_profesional->cod_orcid,
                'digito_dni'=>strlen($usuario->numero_documento),

                /*'programa'=>
                'facultad'=>
                'observaciones'=>*/

            ];
        }
        dd($Dat_reporte);
        /*
        foreach($preinscripciones as $preinscripcion){
            $usuario = User::find($preinscripcion->user_id);
            $preinscripcions[]=[
                'id'=>$preinscripcion->id,
                'user_id'=>$preinscripcion->user_id,
                'tipo_documento_id' => $usuario->tipo_documento_id,
                'numero_documento' =>$usuario->numero_documento,
                'nombres' => $usuario->nombres,
                'primer_apellido' => $usuario->primer_apellido,
                'segundo_apellido' =>$usuario->segundo_apellido,
                'celular' => $usuario->celular,
                'email' => $usuario->email,
            ];
        }*/

/*
        $users=[];
        foreach ($usuarios as $usuario) {
            $users[] = [
                //'id' => $usuario->id,
                'tipo_documento_id' => $usuario->tipo_documento_id,
                'numero_documento' =>$usuario->numero_documento,
                'nombres' => $usuario->nombres,
                'primer_apellido' => $usuario->primer_apellido,
                'segundo_apellido' => $usuario->segundo_apellido,
                'celular' =>$usuario->celular,
                'email' => $usuario->email,
            ];
            $preinscripcion=$preinscripciones[$]

        }



        $datos=[];
        foreach ($datos as $dato) {

            $datos[] = [
                'direccion' => $dato->direccion,
                'calle' =>$dato->calle,
            ];
        }
*/      dd($Dat_reporte);
        return view('exportUsers',[
        'users'=>$Dat_reporte,
        ]);
    }
    public function collection()
    {
        return User::all();
    }
}
