#!/bin/bash
set -e

# Default PORT to 10000 if not provided by Render
PORT="${PORT:-10000}"
export PORT

# Update Apache port listening
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/*.conf

# Create .env if not exists
if [ ! -f /var/www/html/.env ]; then
    echo "Creating .env from .env.example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Ensure storage link
php artisan storage:link || true

# Prepare database if sqlite
DB_CONN="${DB_CONNECTION:-sqlite}"
if [ "$DB_CONN" = "sqlite" ]; then
    mkdir -p /var/www/html/database
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        echo "Creating database.sqlite..."
        touch /var/www/html/database/database.sqlite
    fi
    chown -R www-data:www-data /var/www/html/database
    chmod -R 775 /var/www/html/database
fi

# Generate APP_KEY if missing
if [ -z "$APP_KEY" ]; then
    if ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
        echo "Generating APP_KEY..."
        php artisan key:generate --force
    fi
fi

# Run database migrations
echo "Running migrations..."
php artisan migrate --force || true

# Seed database if users table is empty
USER_COUNT=$(php artisan tinker --execute="echo App\Models\User::count();" 2>/dev/null || echo 0)
if [ "$USER_COUNT" = "0" ]; then
    echo "First time setup: seeding database..."
    php artisan db:seed --force || true
fi

# Cache optimization for production
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting Apache on port ${PORT}..."
exec apache2-foreground
