<?php 

namespace Src\Routes;

use Src\Controllers\TestController;

class Route{
    public function __construct()
    {
        $this->addRoute('GET', '/accomodations', TestController::class, 'index');
    }

    private $routes = [];

    public function addRoute($method, $path, $controllerClass, $controllerMethod) {
        $this->routes[$method][$path] = [
            'controller' => $controllerClass,
            'method' => $controllerMethod
        ];
    }

    public function handleRequest($method, $uri) {

        $path = parse_url($uri)['path'];

        if (isset($this->routes[$method][$path])) {
            $route = $this->routes[$method][$path];
            $controller = new $route['controller']();
            $method = $route['method'];

            if (method_exists($controller, $method)) {

                $controller->$method();

            } else {
                http_response_code(500);
                echo 'Route or method do not exist';
            }
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }

}