<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
   /*
    |------------------------------------------------ ----------------------------------------
    | Inlogcontroller
    |------------------------------------------------ ----------------------------------------
    |
    | Deze controller zorgt voor authenticatie van gebruikers voor de applicatie en
    | ze omleiden naar uw startscherm. De controller gebruikt een eigenschap
    | om zijn functionaliteit gemakkelijk aan uw toepassingen te bieden.
    |
    */

    use AuthenticatesUsers;

    /**
     * Waar kunnen gebruikers worden omgeleid nadat ze zijn ingelogd.
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
        $this->middleware('guest')->except('logout');
    }
}
