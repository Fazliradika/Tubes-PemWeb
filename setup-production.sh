#!/bin/bash

echo "🚀 Setting up Production Database..."

# Run migrations
echo "📦 Running migrations..."
php artisan migrate --force

# Seed doctors
echo "👨‍⚕️ Seeding doctors..."
php artisan db:seed --class=DoctorSeeder --force

# Seed test patient (optional)
echo "👤 Creating test patient account..."
php artisan db:seed --class=PatientTestSeeder --force

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Setup completed!"
echo ""
echo "📝 Test Credentials:"
echo "   Patient: patient@test.com / password123"
echo "   Doctors: [name]@hospital.com / password123"
echo ""
