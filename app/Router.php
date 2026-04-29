<?php

class Router {
    protected $routes = [];

    // Map a GET request
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    // Map a POST request
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    // Dispatch the incoming request
    public function dispatch($url) {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = '/' . trim($url, '/');

        // Allow matching exact paths
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];
            
            if (is_array($callback)) {
                $controllerName = $callback[0];
                $methodName = $callback[1];
                $controller = new $controllerName();
                return $controller->$methodName();
            } else {
                return call_user_func($callback);
            }
        }

        // Wildcard catch-all (e.g. /*)
        if (isset($this->routes[$method]['/*'])) {
            $callback = $this->routes[$method]['/*'];
            if (is_array($callback)) {
                $controller = new $callback[0]();
                return $controller->{$callback[1]}();
            }
            return call_user_func($callback);
        }

        // Handle 404
        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
