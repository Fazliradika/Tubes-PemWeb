#!/bin/bash
# Railway Migration Script for New Features

echo "🚀 Starting Railway deployment setup..."

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Clear all caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment setup complete!"
