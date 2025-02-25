# Documentación del Proyecto

Esta documentación proporciona una visión general del proyecto, la estructura utilizada y los requisitos necesarios para su correcto funcionamiento. En este caso, se ha implementado una arquitectura DDD con estructuración *type-based* debido a que es un único requerimiento. Sin embargo, para proyectos más grandes, se recomienda utilizar la estrucutracion *screaming*.


## Requisitos del Proyecto

- **Arquitectura**: DDD (Domain-Driven Design)
- **Frameworks**: No se han utilizado frameworks
- **ORM**: Utilización única de la librería Doctrine
- **Variables de Entorno**: `phpdotenv` para el uso de variables de entorno (ver archivo `.env.example`)
- **Pruebas Unitarias**: Utilizando PHPUnit

## Archivo de Configuración

Cree un archivo `.env` siguiendo el formato proporcionado en el archivo `.env.example`.

Es esencial que la base de datos haya sido creada y que su nombre esté definido en el archivo `.env`.



## Requisitos de Docker

- **Docker**: Debe estar instalado en su sistema.
- Ejecute el siguiente comando en la ruta raíz del proyecto:

~~~bash
docker-compose up -d
~~~

## Rutas

A continuación, se presentan ejemplos de solicitudes HTTP que pueden ser utilizadas en el proyecto:

### Solicitud DELETE

~~~http
DELETE http://localhost:80/public/user?id=1d6ae4f65b89405fe9da8c1e65ec3c08
~~~

### Solicitud GET

~~~http
GET http://localhost:80/public/user?id=1d6ae4f65b89405fe9da8c1e65ec3c08
~~~

### Solicitud POST

~~~http
POST http://localhost:80/public/user
{
  "name": "Jane Doe",
  "email": "janedoes@example.com",
  "password": "StrongPass#99"
}
~~~



### Ejecución de Pruebas Unit

Para ejecutar las pruebas, utilice el siguiente comando en el contenedor, asegurándose de estar en la ruta raíz del proyecto donde se encuentra el archivo `phpunit.xml`:

~~~bash
vendor/bin/phpunit
~~~


# Extras:
## Requisitos para Correr Localmente

- **Servidor**: Apache o NGINX, o una herramienta como XAMPP
- **PHP**: Versión mayor a 8.2
- **MySQL**
- **Composer**

### Instalación del Proyecto

1. Descargue el proyecto.
2. Ejecute el siguiente comando para instalar las dependencias:

~~~bash
composer install
~~~
## Creación de Tablas

La creación de las tablas se realiza a partir de las entidades utilizando el siguiente comando:

~~~bash
php create_tables.php
~~~
