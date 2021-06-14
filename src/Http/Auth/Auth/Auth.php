<?php

namespace Bubu\Http\Auth\Auth;

use Bubu\Database\Database;
use Bubu\Http\Session\Session;

class Auth
{
    public static function isAuth(): bool
    {
        $token = Session::get('token');
        $id    = Session::get('id');
        if (
            (is_object($token)
            || is_object($id))
            && (get_class($token) === SessionException::class
            || get_class($id) === SessionException::class)
        ) {
            return false;
        } else {
            $userIsset =
            Database::queryBuilder('users')
                ->select('id')
                ->where(
                    [
                        'id',
                        ['?' => $id ]
                    ],
                    [
                        'token',
                        ['?' => $token]
                    ]
                )
                ->fetch()
            ;
            if ($userIsset === false) return false;
            else return true;
        }
    }

    public static function getId(): int
    {
        if (!self::isAuth()) {
            return 0;
        } else {
            return Session::get('id');
        }
    }

    public static function fakeAuth(): void
    {
        Session::set('id', 3);
        Session::set('token', 'test2');
    }
}
