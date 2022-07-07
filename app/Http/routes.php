<?php

use Bubu\Router\Router;

Router::controllerNamespace('App\\Http\\Controller');
Router::controllerSuffix('Controller');

Router::get('/', 'Home#create');
Router::get('/validEmail/:code', 'AccountUpdate#verifyEmail');

Router::get('/signup', 'Register#create');

Router::post('/api/account/register', 'RegisterApi#register');
Router::post('/api/account/login', 'LoginApi#login');
Router::post('/api/account/update/email', 'AccountUpdate#email');
Router::post('/api/account/update/token', 'AccountUpdate#token');
Router::post('/api/account/update/password', 'AccountUpdate#password');

Router::check();