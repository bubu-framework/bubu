<?php
namespace App\Controller;

use App\User;
use App\Views\Page;

class SignupController
{
    /**
     * @return never
     */
    public static function create()
    {
        if (!$_SESSION['authorize']['level1']) {
            (new Page)->show('error', 403, $GLOBALS['lang']['unauthorize']);
        } elseif ($_SESSION['authorize']['level2']) {
            header('Location: /home');
            exit;
        } else {
            (new Page)->show('signup');
        }
    }

    public static function store()
    {
        if (!$_SESSION['authorize']['level1']) {
            (new Page)->show('error', 403, $GLOBALS['lang']['unauthorize']);
        } else {
            $user = new User();
            $return = $user->getNewAccount($_POST['username'], $_POST['mail'], $_POST['password'], $_POST['passwordConfirm']);
            if ($return === true) {
                header('Location: /login');
                exit;
            } else {
                (new Page)->show('error', 457, $return);
            }
        }
    }
}
