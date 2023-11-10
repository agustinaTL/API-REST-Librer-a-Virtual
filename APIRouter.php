<?php
require_once 'libs/Router.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('libros', 'GET', 'LibrosApiController', 'obtenerLibros');
$router->addRoute('libros', 'POST', 'LibrosApiController', 'crearLibro');
$router->addRoute('libros/:ID', 'GET', 'LibrosApiController', 'obtenerLibro');
$router->addRoute('libros/:ID', 'PUT', 'LibrosApiController', 'modificarDatos');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
