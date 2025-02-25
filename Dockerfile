# Imagen base de PHP-FPM
FROM php:8.2.4-fpm

# Instala las extensiones necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    nginx \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:2.8.5 /usr/bin/composer /usr/local/bin/composer

# Define el directorio de trabajo en el contenedor
WORKDIR /var/www/html

# Copia el archivo composer.json y composer.lock al contenedor
COPY composer.json composer.lock ./

# Ejecuta composer install para instalar las dependencias
RUN composer install --no-dev --optimize-autoloader

# Copia el resto de la aplicación
COPY . .

# Copia el archivo de configuración de Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Exponer el puerto 80 para Nginx
EXPOSE 80

# Comando por defecto para iniciar Nginx y PHP-FPM
CMD service nginx start && php-fpm
