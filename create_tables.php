<?php
require __DIR__ . '/vendor/autoload.php';

$entityManager = require __DIR__ . '/config/doctrine.php';

// Crea las tablas basadas en las entidades
$schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
$classes = $entityManager->getMetadataFactory()->getAllMetadata();
$schemaTool->updateSchema($classes);

echo "Tablas creadas exitosamente.\n";
