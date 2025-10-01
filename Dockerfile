FROM php:8.2-apache

# Instalar dependencias necesarias para PostgreSQL y PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Copiar todo tu proyecto al root de Apache
COPY . /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# (Opcional) habilitar mod_rewrite si lo necesitas
RUN a2enmod rewrite
