<?php
require_once 'libs/Router.php';
require_once './app/controllers/LibrosAPIcontroller.php';

require_once './app/controllers/Autor.API.controller.php';
// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('libros', 'GET', 'LibrosApiController', 'obtenerLibros');
$router->addRoute('libros', 'POST', 'LibrosApiController', 'crearLibro');
$router->addRoute('libros/:ID', 'GET', 'LibrosApiController', 'obtenerLibro');
$router->addRoute('libros/:ID', 'PUT', 'LibrosApiController', 'modificarDatos');

$router->addRoute('autor/','GET','autorAPIController','get');
$router->addRoute('autor/:ID','GET','autorAPIController','get');
$router->addRoute('autor','POST','autorAPIController','add');
$router->addRoute('autor/:ID','DELETE','autorAPIController','delete');
$router->addRoute('autor/:ID','PUT','autorAPIController','update');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
