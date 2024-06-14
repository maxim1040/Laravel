<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |------------------------------------------------ ----------------------------------------
    | Bevestig wachtwoordcontroller
    |------------------------------------------------ ----------------------------------------
    |
    | Deze verwerkingsverantwoordelijke is verantwoordelijk voor het afhandelen van wachtwoordbevestigingen en
    | gebruikt een eenvoudige eigenschap om het gedrag op te nemen. Je bent vrij om te verkennen
    | deze eigenschap en negeren alle functies die aanpassing vereisen.
    |
    */


    use ConfirmsPasswords;

    /**
     * Waar moeten gebruikers worden omgeleid wanneer de bedoelde url niet werkt.
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
        $this->middleware('auth');
    }
}
