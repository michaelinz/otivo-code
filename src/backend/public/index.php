<?php

use Src\Routes\Route;

require_once __DIR__ . '/../vendor/autoload.php';


$env = file_get_contents(__DIR__ . '/../.env');

$lines = explode("\n",$env);

foreach($lines as $line){
  preg_match("/([^#]+)\=(.*)/",$line,$matches);
  if(isset($matches[2])){
    putenv(trim($line));
  }
} 

header('Access-Control-Allow-Origin: *');

$uri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER["REQUEST_METHOD"];

$route = new Route();

return $route->handleRequest($requestMethod, $uri);
