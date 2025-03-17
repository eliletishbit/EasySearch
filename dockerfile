# Utiliser une image PHP avec Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires pour Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Activer mod_rewrite pour Apache
RUN a2enmod rewrite

# Installer Composer
RUN apt-get update && apt-get install -y unzip curl git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer Node.js et npm pour Vue.js/Tailwind
RUN apt-get install -y nodejs npm

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le projet Laravel
COPY . .

# Installer les dépendances Laravel et compiler les assets
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Donner les permissions aux dossiers Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Exposer le port 80
EXPOSE 80

# Exécuter le script d’entrée
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
CMD ["/entrypoint.sh"]
