<?php

require_once 'api/clientApiController.php';
require_once 'libs/Router.php';

$router = new Router();


$router->addRoute('clientes/tarjetas/:ID', 'GET', 'clientsApiController', 'getTarjetas');
$router->addRoute('clientes/tarjetas/:ID', 'DELET', 'clientsApiController', 'DeleteTarjeta');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
