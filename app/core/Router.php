<?php
class Router {
    private $routes = [];
    
    public function __construct() {
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];
    }
    
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }
    
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }
    
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = rtrim($path, '/');
        
        if (empty($path)) {
            $path = '/';
        }
        
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];
            
            if (is_array($callback)) {
                $controller = new $callback[0]();
                $method = $callback[1];
                $controller->$method();
            } else {
                call_user_func($callback);
            }
        } else {
            http_response_code(404);
            echo "Page not found";
        }
    }
}
?>