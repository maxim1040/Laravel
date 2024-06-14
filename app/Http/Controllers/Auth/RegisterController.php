<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |------------------------------------------------ ----------------------------------------
    | Registreer controller
    |------------------------------------------------ ----------------------------------------
    |
    | Deze controller regelt zowel de registratie van nieuwe gebruikers als hun
    | validatie en creatie. Standaard gebruikt deze controller een eigenschap om
    | bieden deze functionaliteit zonder dat er aanvullende code nodig is.
    |
    */
    use RegistersUsers;

    /**
     * Waar kunnen gebruikers worden omgeleid na registratie.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Maak een nieuwe controllerinstantie.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Ontvang een validator voor een inkomend registratieverzoek.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthday' => ['required', 'date'],
            'about' => ['required', 'string' ,'max:255'],
            //hier zeg je alle parameters van je register
        ]);
    }

    /**
     * Maak een nieuwe gebruikersinstantie aan na een geldige registratie.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthday' => $data['birthday'],
            'about'    => $data['about'],
            
        ]);
    }
}
