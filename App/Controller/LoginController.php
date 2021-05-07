<?php
namespace App\Controller;

use App\User;
use App\Views\Page;

class LoginController
{
    /**
     * @return never
     */
    public static function create()
    {
        if ($_SESSION['authorize']['level1']) {
            header('Location: /');
        } else {
            (new Page)->show('login');
        }
    }

    public static function store()
    {
        $user = new User();
        $return = $user->getConnexion($_POST['username'], $_POST['password'], isset($_POST['keepConnexion']));
        if ($return === true) {
            $_SESSION['authorize']['level2'] = true;
            if ($user->getInformation('type') == 2) {
                $_SESSION['authorize']['level3'] = true;
            }
            $_SESSION['username'] = $_POST['username'];
            header('Location: /home');
            exit;
        } else {
            (new Page)->show('error', 457, $return);
        }
    }
}
