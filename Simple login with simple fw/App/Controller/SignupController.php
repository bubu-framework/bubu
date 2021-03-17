<?php
namespace App\Controller;

use App\User;
use App\Views\Base;

class Signup
{
    public static function create()
    {
        if (!$_SESSION['authorize']['level1']) {
            Base::show('error', 403, 'Vous n\'êtes pas autorisé à rentrer sur cette page.');
        } elseif ($_SESSION['authorize']['level2']) {
            header('Location: /challenges');
            exit;
        } else {
            Base::show('signup');
        }
    }

    public static function store()
    {
        if (!$_SESSION['authorize']['level1']) {
            Base::show('error', 403, 'Vous n\'êtes pas autorisé à rentrer sur cette page.');
        } else {
            $user = new User();
            $return = $user->getNewAccount($_POST['username'], $_POST['mail'], $_POST['password'], $_POST['passwordConfirm']);
            if ($return === true) {
                header('Location: /login');
                exit;
            } else {
                Base::show('error', 457, $return);
            }
        }
    }
}
