<?php
namespace App\Controller;

use App\Views\Page;
use Bubu\Http\Auth\Authorization\Roles\RoleManager;
use Bubu\Http\HttpRequire\HttpRequire;

class HomeController
{
    /**
     * @return never
     */
    public static function create()
    {
        HttpRequire::https();
        (new Page)->httpCode(101)->httpMessage('Messages super')->hasAuthorization(RoleManager::role('random'))->show('home');
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
