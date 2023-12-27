<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
Use App\Models\TipoDocumento;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $tipoDocumentos = TipoDocumento::all();
        return view('auth.register', compact('tipoDocumentos'));
    }


    public function store(Request $request): RedirectResponse
{
    $rules = [
        'nombres' => ['required', 'string', 'max:255'],
        'celular' => ['required', 'string', 'max:15', 'indisposable'],
        'tipo_documento_id' => 'required|exists:tipo_documentos,id',
        'numero_documento' => ['required', 'string', 'max:15', 'unique:users,numero_documento', 'indisposable'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'indisposable'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'cant_apellidos' => ['required', 'in:1,2'], // Validar que la cantidad de apellidos sea 1 o 2.
    ];

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
        'primer_apellido' => strtoupper($request->input('primer_apellido'))
    ];

    if ($request->input('cant_apellidos') == 2) {
        $userData['segundo_apellido'] = strtoupper($request->input('segundo_apellido'));
    }

    $user = User::create($userData);


    // Asignar el rol después de crear el usuario
    $user->assignRole('Postulante');

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}

}
