#!/bin/bash

# Run migrations
php artisan migrate --force

# Start PHP built-in server
php -S 0.0.0.0:${PORT:-8000} -t public/
