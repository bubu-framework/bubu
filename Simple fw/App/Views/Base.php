<?php
namespace App\Views;

class Base
{
    public static function show(string $page, $code = null, string $message = '')
    {
        if (!is_null($code)) {
            http_response_code($code);
        }

        require 'templates/header.php';
        require "templates/{$page}.php";
        require 'templates/footer.php';
        exit;
    }
}
