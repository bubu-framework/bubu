<?php
namespace App;

use Bubu\Router\Router;

$router = new Router($_GET['url']);

$router->get('/', 'Home#create');
$router->get('/logout', 'Home#logout');

$router->get('/login', 'Login#create');
$router->post('/login', 'Login#store');

$router->get('/signup', 'Signup#create');
$router->post('/signup', 'Signup#store');

$router->get('/admin', 'Admin#create');

$router->run();