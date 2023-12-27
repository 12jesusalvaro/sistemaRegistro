<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Preinscripcion;
use App\Models\Postulante;

class UploadController extends Controller
{
    public function store(Request $request)
     {
         $max_size = (int) ini_get('upload_max_filesize') * 10240;

         // Conseguir el ID del postulante
         $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
         $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();
         $postulanteId = $postulante->id;

         // Nombres predefinidos de los archivos
         $nombreArchivos = [
             'Solicitud',
             'CartaCompromiso',
             'DeclaracionJuarada',
             'GradoAcademico',
             'CV',
             'ProyectoInvestigacion',
             'DNI',
             'Fotografia',
         ];

         $files = $request->file('files');

         $validator = Validator::make($request->all(), [
             'files.*' => 'required|file|mimes:pdf,png,jpeg,jpg|max:' . $max_size,
         ]);

         if ($validator->fails()) {
             Alert::error('Error', 'Debes subir los archivos');
             return redirect()->back()->withErrors($validator)->withInput();
         } else {
             if ($request->hasFile('files')) {
                 foreach ($files as $index => $file) {
                     if ($index < count($nombreArchivos)) {
                         // Usar el nombre predefinido para el archivo
                         $nombreArchivo = $nombreArchivos[$index];
                     } else {
                         // Si hay más archivos de los esperados, usa un nombre genérico con el índice
                         $nombreArchivo = 'Archivo' . ($index + 1);
                     }

                     if (Storage::putFileAs('/public/' . $postulanteId . '/', $file, $nombreArchivo . '.' . $file->getClientOriginalExtension())) {
                         File::create([
                             'name' => $nombreArchivo . '.' . $file->getClientOriginalExtension(),
                             'postulante_id' => $postulanteId,
                         ]);
                     }
                 }

                 Alert::success('Éxito', 'Se han subido los archivos correctamente');
                 return redirect()->route('finalizado');
             }
         }


         /*if ($request->hasFile('files')) {
             $files = $request->file('files');

             foreach ($files as $file) {
                 // Procesar cada archivo aquí (ejemplo: almacenar en disco, guardar en base de datos, etc.)
                 $file->store('uploads');
             }

             return "Archivos subidos exitosamente";
         }*/

         //return "No se encontraron archivos para subir";
     }

     public function updta(Request $request)
    {

        $max_size=(int)ini_get('upload_max_filesize')*10240;
        //conseguir id del postulante
        $preinscripcion = Preinscripcion::where('user_id', $request->user()->id)->latest()->first();
        $postulante = Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

        $guardarArchivos = new InfAcademica();
        $postulanteId = $postulante->id;
        //$guardarArchivos->postulante_id = $postulanteId;
        //$guardarArchivos->save();

       // $user_id= $request->user()->id;

        $validator = Validator::make($request->all(), [
         //'files'=>'required|array',
         'files.*' => 'required|file|mimes:pdf,png,jpg|max:' . $max_size,
         ]);
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
             Alert::error('!Error!', 'Debes subir los archivos');
            return back();
         }else{
            $files = $request->file('files');

            if ($request->hasFile('files')) {
            foreach ($files as $file) {
                if(Storage::putFileAs('/public/'.$postulanteId.'/',$file,$file->getClientOriginalName())){
                    File::create([
                        'name'=>$file->getClientOriginalName(),
                        'postulante_id'=>$postulanteId
                    ]);
                }
            }
            Alert::success('!Éxito', 'Se ha subido sus archivos');
            //return redirect()->route('finalizado');
         }
         return redirect()->route('finalizado');
        }
    }
    /**
     * Display the specified resource.
     */
}
