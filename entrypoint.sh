#!/bin/bash

# Copier le fichier .env s'il n'existe pas
if [ ! -f ".env" ]; then
  cp .env.example .env
fi

# Attendre que MySQL démarre
echo "Waiting for MySQL..."
until nc -z -v -w30 db 3306; do
  echo "Waiting for database connection..."
  sleep 5
done

# Générer la clé Laravel
php artisan key:generate

# Exécuter les migrations
php artisan migrate --force

# Donner les permissions nécessaires
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Lancer Apache
apache2-foreground

chmod +x entrypoint.sh
