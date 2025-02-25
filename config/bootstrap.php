<?php

$routes = [];
foreach (glob(__DIR__ . '/../src/App/Infrastructure/Routes/**/*.php') as $file) {
    $route = require $file;
    foreach ($route as $method => $paths) {
        if (!isset($routes[$method])) {
            $routes[$method] = [];
        }
        $routes[$method] = array_merge($routes[$method], $paths);
    }
}