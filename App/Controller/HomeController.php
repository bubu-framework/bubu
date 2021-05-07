<?php
namespace App\Controller;

use App\Views\Page;

class HomeController
{
    /**
     * @return never
     */
    public static function create()
    {
        (new Page)->show('home');
    }

    public static function logout()
    {
        $_SESSION['load'] = false;
        session_reset();
        session_unset();
        session_destroy();
        header('Location: /');
        exit($GLOBALS['lang']['disconnect']);
    }
}
