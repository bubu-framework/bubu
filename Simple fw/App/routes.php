<?php

use App\Controller\Controller;

$router = new AltoRouter();

$router->map('GET', '/', Controller::home('create'));