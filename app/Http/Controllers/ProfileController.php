<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

use Stevebauman\Countries\CountriesFacade as Countries;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Verificar la cantidad de apellidos y aplicar reglas de validación dinámicas
        if ($request->input('cant_apellidos') == 2) {
            $rules['primer_apellido'] = ['required', 'string', 'max:30', 'indisposable'];
            $rules['segundo_apellido'] = ['required', 'string', 'max:30', 'indisposable'];
        } elseif ($request->input('cant_apellidos') == 1) {
            $rules['primer_apellido'] = ['required', 'string', 'max:30', 'indisposable'];
            // Eliminamos la regla 'segundo_apellido' cuando se selecciona un solo apellido
            unset($rules['segundo_apellido']);
        }

        $request->validate($rules);

        $userData = [
            'nombres' => strtoupper($request->input('nombres')),
            'celular' => $request->input('celular'),
            'numero_documento' => $request->input('numero_documento'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'cant_apellidos' =>$request->input('cant_apellidos'),
            'primer_apellido' =>  strtoupper($request->input('primer_apellido')),
        ];


        if ($request->input('cant_apellidos') == 2) {
            $userData['segundo_apellido'] = strtoupper($request->input('segundo_apellido'));
        } else {
            // Establecemos el segundo apellido como nulo si se selecciona un solo apellido
            $userData['segundo_apellido'] = null;
        }

        $user->update($userData);

        return redirect()->route('profile.edit')->with('status', 'Perfil-Actualizado');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
