<?php

namespace Bubu\Utils\Form;

use Bubu\Utils\Form\Templates\Login;

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
}
