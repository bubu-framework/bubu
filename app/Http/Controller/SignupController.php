<?php

namespace App\Http\Controller;

use Bubu\View\View;

class SignupController
{
    public static function create()
    {
        (new View)->show('signup');
    }
}
