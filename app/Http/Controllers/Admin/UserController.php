<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Secretaria;
use App\Models\Evaluador;
use App\Models\Contador;
use App\Models\Mencion;
use App\Models\TipoDocumento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    use WithPagination;
    public $search;

   /* public function index(Request $request)
    {
        //$users = User::all();
        //$search = $request->input('search');

       /* $users = User::where('name', 'LIKE', '%'.$search.'%')->get();
        $users = new \Illuminate\Pagination\LengthAwarePaginator($users, $users->count(),10);
        */

        /*$users = User::where('name', 'LIKE', '%'.$this->search. '%')
                 ->orWhere('email', 'LIKE', '%'.$this->search. '%')
                 ->paginate(10);

        return view('admin.index', compact('users'));
    }*/

    public function index(Request $request)
    {
        $search = trim($request->input('search'));   //trim borra espacios en blanco al inicio y final

        /*$users = User::whereDoesntHave('roles', function ($query) use ($search){
            $query->where('name', 'Postulante');
        })->paginate(10);*/

        //dd($userss);
        /*$query = User::where('nombres', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('numero_documento', 'LIKE', '%' . $search . '%')
            ->orWhere('celular', 'LIKE', '%' . $search . '%')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Postulante');
            });*/
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Postulante');
            })
            ->where(function ($query) use ($search) {
                $query->where('nombres', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('numero_documento', 'LIKE', '%' . $search . '%')
                    ->orWhere('celular', 'LIKE', '%' . $search . '%');
            })
            ->paginate(10);

            //dd($query->toSql(), $query->getBindings());
        //$users = $query->paginate(10);
        return view('admin.users.index', compact('users', 'search'));
    }

    public function pdf(){
        $users=User::all();
        $pdf = Pdf::loadView('admin.users.pdf', compact('users'));
        return $pdf->stream();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$roles = Role::pluck('name', 'name')->all();
        $roles = Role::whereNotIn('name', ['Postulante'])->pluck('name', 'name')->all();

        $menciones = Mencion::all();
        $tipo_documentos = TipoDocumento::all();
        return view('admin.users.create', compact('menciones','roles', 'tipo_documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => ['required', 'string'],
            'primer_apellido' => 'required',
            'celular' => 'required',
            'tipo_documento_id' => 'required',
            'numero_documento' => 'required|unique:users,numero_documento',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'menciones' => 'required',
            'cant_apellidos' => ['required', 'in:1,2'], // Validar que la cantidad de apellidos sea 1 o 2.

        ]);

            // Verificar la cantidad de apellidos y aplicar reglas de validación dinámicas
            if ($request->input('cant_apellidos') == 2) {
                $rules['primer_apellido'] = ['required', 'string', 'max:30', 'indisposable'];
                $rules['segundo_apellido'] = ['required', 'string', 'max:30', 'indisposable'];
            } elseif ($request->input('cant_apellidos') == 1) {
                $rules['primer_apellido'] = ['required', 'string', 'max:30', 'indisposable'];
            }

        $request->validate($rules);

        $userData = [
            'nombres' => strtoupper($request->input('nombres')),
            'celular' => $request->input('celular'),
            'tipo_documento_id' => $request->input('tipo_documento_id'),
            'numero_documento' => $request->input('numero_documento'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'cant_apellidos' =>$request->input('cant_apellidos'),
            'primer_apellido' => strtoupper($request->input('primer_apellido')),
            'segundo_apellido' => NULL,
        ];

        if ($request->input('cant_apellidos') == 2) {
            $userData['segundo_apellido'] = strtoupper($request->input('segundo_apellido'));
        }

        $user = User::create($userData);

        $selectedRole = $request->input('roles');

        //dd($selectedRole);

        if ($selectedRole[0] == 'Secretaria') {
            $user->assignRole('Secretaria');
            // Crear la secretaria y relacionarla con el usuario
            $secretaria = new Secretaria([
                'mencion_id' => $request->input('menciones'),
            ]);
            $user->secretaria()->save($secretaria);
        } elseif ($selectedRole[0] == 'Evaluador') {
            $user->assignRole('Evaluador');
            $evaluador = new Evaluador([
                'mencion_id' => $request->input('menciones'),
            ]);
            $user->evaluador()->save($evaluador);
        }elseif ($selectedRole[0] == 'Contador') {
            $user->assignRole('Contador');
            $contador = new Contador([
                'mencion_id' => $request->input('menciones'),
            ]);
            $user->contador()->save($contador);
        }else{
            $user->assignRole($request->input('roles'));
        }
        // Send notification of validation for email
        $user->sendEmailVerificationNotification();

        Alert::success('!Éxito', 'Se a creado el usuario');

        return redirect()->route('admin.users.index' );
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
    public function edit($id)
    {
        $user = User::find($id);
        //$roles = Role::pluck('name', 'name')->all();
        $roles = Role::whereNotIn('name', ['Postulante'])->pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $tipo_documentos = TipoDocumento::all();
        //$menciones = Mencion::all();
        $menciones = Mencion::pluck('nombre', 'id');

        if($user->secretaria){
            $userMencion = $user->secretaria->mencion_id;
            return view('admin.users.edit', compact('menciones', 'user', 'roles', 'userRole', 'tipo_documentos', 'userMencion'));
        }elseif($user->evaluador){
            $userMencion = $user->evaluador->mencion_id;
            return view('admin.users.edit', compact('menciones', 'user', 'roles', 'userRole', 'tipo_documentos', 'userMencion'));
        }elseif($user->contador){
            $userMencion = $user->contador->mencion_id;
            return view('admin.users.edit', compact('menciones', 'user', 'roles', 'userRole', 'tipo_documentos', 'userMencion'));
        }else{
            $userMencion = 1;
            return view('admin.users.edit', compact('menciones', 'user', 'roles', 'userRole', 'tipo_documentos', 'userMencion'));
        }
        //return view('admin.users.edit', compact('menciones','user', 'roles', 'userRole', 'tipo_documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombres' => 'required',
            'primer_apellido' => 'required',
            'celular' => 'required',
            'tipo_documento_id' => 'required',
            'numero_documento' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'cant_apellidos' => ['required', 'in:1,2'], // Validar que la cantidad de apellidos sea 1 o 2.
            'segundo_apellido' => 'required_if:cant_apellidos,2',

        ]);

        $input = $request->all();
        $input['nombres'] = strtoupper($input['nombres']);
        $input['primer_apellido'] = strtoupper($input['primer_apellido']);
        $input['segundo_apellido'] = ($input['cant_apellidos'] == 1) ? null : strtoupper($input['segundo_apellido']);

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $selectedRole = $request->input('roles');

        //dd($user->getRoleNames());
        //$user->assignRole($request->input('roles'));
        //cambia de rol a los usuarios y elimina una asociacion de rol anterior
        if ($selectedRole[0] == 'Secretaria') {
            if($user->evaluador){
                $user->evaluador->delete();
                $user->removeRole('Evaluador');
            }
            if($user->contador){
                $user->contador->delete();
                $user->removeRole('Contador');
            }
            if($user->hasRole('Admin')){
                $user->removeRole('Admin');
            }
            if ($user->secretaria) {
                $user->removeRole('Secretaria');
                $user->assignRole('Secretaria');
                $secretaria = $user->secretaria()->find($user->secretaria->id);
                $secretaria->mencion_id = $request->input('menciones');
                $secretaria->save();
            } else {
                $user->assignRole('Secretaria');
                // Crear la secretaria y relacionarla con el usuario
                $secretaria = new Secretaria([
                    'mencion_id' => $request->input('menciones'),
                ]);
                $user->secretaria()->save($secretaria);
            }

        } elseif ($selectedRole[0] == 'Evaluador') {
            if($user->secretaria){
                $user->secretaria->delete();
                $user->removeRole('Secretaria');
            }
            if($user->contador){
                $user->contador->delete();
                $user->removeRole('Contador');
            }
            if($user->hasRole('Admin')){
                $user->removeRole('Admin');
            }

            if ($user->evaluador) {
                $user->removeRole('Evaluador');
                $user->assignRole('Evaluador');
                $evaluador = $user->evaluador()->find($user->evaluador->id);
                $evaluador->mencion_id = $request->input('menciones');
                $evaluador->save();
            } else {
                $user->removeRole('Evaluador');
                $user->assignRole('Evaluador');
                $evaluador = new Evaluador([
                    'mencion_id' => $request->input('menciones'),
                ]);
                $user->evaluador()->save($evaluador);
            }

        }elseif ($selectedRole[0] == 'Contador') {
            if($user->secretaria){
                $user->secretaria->delete();
                $user->removeRole('Secretaria');
            }
            if($user->evaluador){
                $user->evaluador->delete();
                $user->removeRole('Evaluador');
            }
            if($user->hasRole('Admin')){
                $user->removeRole('Admin');
            }
            if ($user->contador) {
                $user->removeRole('Contador');
                $user->assignRole('Contador');
                $contador = $user->contador()->find($user->contador->id);
                $contador->mencion_id = $request->input('menciones');
                $contador->save();
            } else {
                $user->removeRole('Contador');
                $user->assignRole('Contador');
                $contador = new Contador([
                    'mencion_id' => $request->input('menciones'),
                ]);
                $user->contador()->save($contador);
            }

        }else{
            if($user->secretaria){
                $user->secretaria->delete();
                $user->removeRole('Secretaria');
            }
            if($user->evaluador){
                $user->evaluador->delete();
                $user->removeRole('Evaluador');
            }
            if($user->contador){
                $user->contador->delete();
                $user->removeRole('Contador');
            }
            if($user->hasRole('Admin')){
                $user->removeRole('Admin');
            }
            $user->assignRole($request->input('roles'));
        }

        Alert::success('¡Éxito', 'Se a actualizado el usuario!');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')->with('eliminar', 'ok');
    }
}
