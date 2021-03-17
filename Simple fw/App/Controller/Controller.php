<?php
namespace App\Controller;

use App\Controller\Home;

class Controller
{
    public static function home($method)
    {
        $method === 'store' ? Home::store() : Home::create();
    }
}
