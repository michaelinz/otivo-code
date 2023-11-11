<?php

use Src\Routes\Route;

require_once __DIR__ . '/../vendor/autoload.php';
header('Access-Control-Allow-Origin: *');

$uri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER["REQUEST_METHOD"];

$route = new Route();

return $route->handleRequest($requestMethod, $uri);
