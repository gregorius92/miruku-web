#!/bin/sh
set -e

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
RETRIES=30

# Extract DB config from .env
if [ -f ".env" ]; then
    DB_HOST=$(grep "^DB_HOST=" .env | cut -d '=' -f2 | tr -d '\r')
    DB_PORT=$(grep "^DB_PORT=" .env | cut -d '=' -f2 | tr -d '\r')
    DB_USER=$(grep "^DB_USERNAME=" .env | cut -d '=' -f2 | tr -d '\r')
    DB_PASS=$(grep "^DB_PASSWORD=" .env | cut -d '=' -f2 | tr -d '\r')
else
    echo ".env file not found, skipping DB wait."
    RETRIES=0
fi

if [ "$RETRIES" -gt 0 ]; then
    until php -r "try { new PDO('mysql:host=$DB_HOST;port=$DB_PORT', '$DB_USER', '$DB_PASS'); } catch (Exception \$e) { exit(1); }" || [ $RETRIES -eq 0 ]; do
      echo "MySQL is still unavailable at $DB_HOST:$DB_PORT. Retrying in 2 seconds... ($RETRIES retries left)"
      RETRIES=$((RETRIES - 1))
      sleep 2
    done

    if [ $RETRIES -eq 0 ]; then
      echo "Warning: MySQL did not become ready in time. Proceeding anyway..."
    else
      echo "MySQL is ready!"
    fi
fi

# Run initial commands for Laravel setup
if [ ! -f "vendor/autoload.php" ]; then
    echo "Installing composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if [ ! -f ".env" ]; then
    echo "Creating .env file..."
    cp .env.example .env
    php artisan key:generate
fi

# Migrations and seeders are disabled per user request
# echo "Running migrations..."
# php artisan migrate --force
# echo "Running seeders..."
# php artisan db:seed --force

echo "Linking storage..."
php artisan storage:link || true

# Permissions handled by matching host UID.


echo "Clearing cache..."
php artisan cache:clear || true
php artisan config:clear || true
php artisan view:clear || true

echo "Starting PHP-FPM..."
exec "$@"
