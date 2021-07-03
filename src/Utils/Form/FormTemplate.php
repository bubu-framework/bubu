<?php

namespace Bubu\Utils\Form;

use Bubu\Utils\Form\Templates\Login;
use Bubu\Utils\Form\Templates\Signup;

class FormTemplate
{

    public static function login(string $action, string $method): string
    {
        return Login::login($action, $method);
    }

    public static function loginVerify(array $requestData): bool
    {
        return Login::loginVerify($requestData);
    }

    public static function signup(string $action, string $method): string
    {
        return Signup::signup($action, $method);
    }

    public static function signupVerify(array $requestData): bool
    {
        // return Login::loginVerify($requestData);
        return false;
    }
}
