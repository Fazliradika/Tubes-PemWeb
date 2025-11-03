#!/usr/bin/env bash
set -eo pipefail

echo "=========================================="
echo "Laravel Deployment Start Script"
echo "=========================================="
echo "APP_ENV: ${APP_ENV:-not-set}"
echo "APP_KEY: ${APP_KEY:0:20}..." # Show first 20 chars only
echo "DB_CONNECTION: ${DB_CONNECTION:-not-set}"
echo "DB_HOST: ${DB_HOST:-not-set}"
echo "=========================================="

# Ensure correct permissions and create necessary directories
echo "Setting storage permissions..."
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs || true
chown -R www-data:www-data storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

# Run migrations (ignore errors if DB is not reachable to avoid crash-loop; surface in logs)
echo "Running migrations..."
if php artisan migrate --force; then
  echo "✓ Migrations completed."
  
  # Run seeders to create initial users (admin, doctors, patients)
  echo "Running database seeders..."
  if php artisan db:seed --force; then
    echo "✓ Database seeded successfully."
  else
    echo "⚠ Warning: seeding failed or already seeded." >&2
  fi
else
  echo "⚠ Warning: migrations failed; continuing to start web server." >&2
fi

# Clear all caches
echo "Clearing caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Optimize for production
echo "Caching config/routes/views..."
php artisan config:cache || echo "⚠ Config cache failed" >&2
php artisan route:cache || echo "⚠ Route cache failed" >&2
php artisan view:cache || echo "⚠ View cache failed" >&2

# Configure Apache to listen on provided PORT (Railway sets $PORT)
PORT_ENV=${PORT:-8080}
echo "Configuring Apache to listen on port ${PORT_ENV}..."
sed -ri "s/^Listen .*/Listen ${PORT_ENV}/" /etc/apache2/ports.conf || true
sed -ri "s#<VirtualHost \*:.*>#<VirtualHost *:${PORT_ENV}>#" /etc/apache2/sites-available/000-default.conf || true

echo "=========================================="
echo "✓ Startup complete! Starting Apache..."
echo "=========================================="
exec apache2-foreground
