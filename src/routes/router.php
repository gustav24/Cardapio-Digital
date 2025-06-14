<?php
class Router {
    private $routes = [];

    public function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                $controller = new $route['controller']();
                $action = $route['action'];
                $controller->$action();
                return;
            }
        }
        
        // If no route is found, show 404
        header("HTTP/1.0 404 Not Found");
        include 'public/404.html';
    }
}
?> 