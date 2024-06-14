<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |------------------------------------------------ ----------------------------------------
    | Wachtwoord reset-controller
    |------------------------------------------------ ----------------------------------------
    |
    | Deze controller is verantwoordelijk voor het afhandelen van e-mails voor het opnieuw instellen van het wachtwoord en
    | bevat een eigenschap die helpt bij het verzenden van deze meldingen van
    | uw toepassing aan uw gebruikers. Voel je vrij om deze eigenschap te verkennen.
    |
    */

    use SendsPasswordResetEmails;
}
