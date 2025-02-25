<?php

require __DIR__ . '/../vendor/autoload.php';
// require __DIR__ . '/../config/routes.php';

use App\Infrastructure\Persistence\DoctrineUserRepository;
use Doctrine\ORM\EntityManager;

// Configuración de Doctrine
$entityManager = require __DIR__ . '/../config/doctrine.php';

try {
    $connection = $entityManager->getConnection();

    $result = $connection->executeQuery('SELECT 1');
    
    if ($result->fetchOne() === 1) {
        echo "Conexión exitosa a la base de datos.";
    } 
} catch (Exception $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}

// Inicialización Repositorio de Manera Singleton
$userRepository = DoctrineUserRepository::getInstance($entityManager);


require __DIR__ . '/../config/bootstrap.php';

$method = $_SERVER['REQUEST_METHOD'];
$pathWithoutParams=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = "/".basename($pathWithoutParams);
echo "\n".$method.$path;
if (isset($routes[$method][$path])) {
    $routes[$method][$path]();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}