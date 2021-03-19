<?php
namespace App\Router;

use App\Views\Base;

$router = new Router($_GET['url']);
$router->get('css/:file', function ($file) { Base::css($file); });

$router->get('/', 'Home#create');
$router->get('/logout', 'Home#logout');

$router->get('/login', 'Login#create');
$router->post('/login', 'Login#store');

$router->get('/signup', 'Signup#create');
$router->post('/signup', 'Signup#store');

$router->get('/admin', 'Admin#create');

$router->get('/challenges', 'Challenges#create');

$router->run();