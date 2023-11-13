<?php

require_once './libs/Router.php';
require_once './app/controllers/Textos.API.Controller.php';

require_once './app/controllers/Autor.API.Controller.php';

$router = new Router();

// define la tabla de ruteo
//                 (endpoint, verbo, controller, método)
$router->addRoute('textos', 'GET', 'textoAPIController', 'get');
$router->addRoute('textos/:ID', 'GET', 'textoAPIController', 'get');
$router->addRoute('textos/:ID', 'DELETE', 'textoAPIController', 'delete');
$router->addRoute('textos', 'POST', 'textoAPIController', 'add');
$router->addRoute('textos/:ID', 'PUT', 'textoAPIController', 'update');

$router->addRoute('user/token', 'GET', 'UserAPIController', 'getToken');

$router->addRoute('autor/', 'GET', 'autorAPIController', 'get');
$router->addRoute('autor/:ID', 'GET', 'autorAPIController', 'get');
$router->addRoute('autor', 'POST', 'autorAPIController', 'add');
$router->addRoute('autor/:ID', 'DELETE', 'autorAPIController', 'delete');
$router->addRoute('autor/:ID', 'PUT', 'autorAPIController', 'update');

// rutea
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
