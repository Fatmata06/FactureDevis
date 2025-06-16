# Image PHP avec Apache
FROM php:8.2-apache

# Installer extensions nécessaires
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers Laravel dans le conteneur
COPY . /var/www/html

# Travailler dans le dossier Laravel
WORKDIR /var/www/html

# Installer les dépendances Laravel
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Définir les permissions nécessaires
RUN chown -R www-data:www-data storage bootstrap/cache

# Activer mod_rewrite d’Apache
RUN a2enmod rewrite

# Copier config Apache
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
