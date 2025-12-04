<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Handle exact matches
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];
            if (is_array($callback)) {
                $controller = new $callback[0]();
                $methodName = $callback[1];
                return $controller->$methodName();
            }
            return call_user_func($callback);
        }

        // Handle 404
        http_response_code(404);
        echo "404 Not Found";
    }
}
