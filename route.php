<?php
require_once 'libs/Router.php';
require_once 'Controller/JugadoresApiController.php';

$router = new Router();

$router->addRoute('jugadores', 'GET', 'JugadoresApiController', 'obtenerJugadores');
$router->addRoute('jugadores/:ID', 'GET', 'JugadoresApiController', 'obtenerJugador');
$router->addRoute('jugadores/:ID', 'DELETE', 'JugadoresApiController', 'borrarJugador');
$router->addRoute('jugadores', 'POST', 'JugadoresApiController', 'crearJugador');
$router->addRoute('jugadores/:ID', 'PUT', 'JugadoresApiController', 'editarJugador');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);