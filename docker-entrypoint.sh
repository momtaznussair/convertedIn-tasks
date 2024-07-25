#!/bin/sh

# Ensure Composer dependencies are up to date
composer install

# create .env file
php -r "file_exists('.env') || copy('.env.example', '.env');"

# generate app key
php artisan key:generate

# Run migrations and seed the database
php artisan migrate:fresh --force
php artisan db:seed --force

# Clear and cache configurations and routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM
exec "$@"
