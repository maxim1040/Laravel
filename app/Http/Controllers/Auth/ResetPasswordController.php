<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |------------------------------------------------ ----------------------------------------
    | Wachtwoord reset-controller
    |------------------------------------------------ ----------------------------------------
    |
    | Deze controller is verantwoordelijk voor het afhandelen van verzoeken om wachtwoorden opnieuw in te stellen
    | en gebruikt een eenvoudige eigenschap om dit gedrag op te nemen. Je bent vrij om
    | verken deze eigenschap en overschrijf alle methoden die u wilt aanpassen.
    |
    */

    use ResetsPasswords;

    /**
     * Waar kunnen gebruikers worden omgeleid na het opnieuw instellen van hun wachtwoord.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
