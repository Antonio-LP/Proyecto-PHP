<?php

$routes = [];

header('Content-Type: application/json');
if (isset($routes[$method][$path])) {
    $routes[$method][$path]();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}

function route($method, $path, $callback = null) {
    global $routes;

    if ($callback) {
        // Registrar la ruta
        $routes[$method][$path] = $callback;
    } else {
        // Ejecutar la ruta
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if (isset($routes[$method][$path])) {
            header('Content-Type: application/json');
            $routes[$method][$path]();
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Not Found']);
        }
    }
}
