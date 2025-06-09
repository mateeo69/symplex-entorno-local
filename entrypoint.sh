#!/bin/bash
set -e

cd /var/www/html

echo "Ejecutando composer install..."
composer install

echo "Forzando composer dump-autoload..."
composer dump-autoload -o

chown -R www-data:www-data /var/www/html

exec "$@"
