<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
   /*
    |------------------------------------------------ ----------------------------------------
    | E-mailverificatiecontroller
    |------------------------------------------------ ----------------------------------------
    |
    | Deze controller is verantwoordelijk voor het afhandelen van e-mailverificatie voor iedereen
    | gebruiker die zich onlangs bij de toepassing heeft geregistreerd. E-mails mogen ook
    | opnieuw worden verzonden als de gebruiker het oorspronkelijke e-mailbericht niet heeft ontvangen.
    |
    */

    use VerifiesEmails;

    /**
     * Waar kunnen gebruikers worden omgeleid na verificatie.
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
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
