<?php
/**
 * Railway Database Setup Script
 * Run: php railway-setup.php
 */

echo "🚀 Railway Database Setup\n";
echo "========================\n\n";

// Run migrations
echo "1️⃣ Running migrations...\n";
passthru('php artisan migrate --force');

// Seed doctors
echo "\n2️⃣ Seeding doctors...\n";
passthru('php artisan db:seed --class=DoctorSeeder --force');

// Seed test patient
echo "\n3️⃣ Creating test patient...\n";
passthru('php artisan db:seed --class=PatientTestSeeder --force');

// Cache config
echo "\n4️⃣ Caching configuration...\n";
passthru('php artisan config:cache');
passthru('php artisan route:cache');
passthru('php artisan view:cache');

// Verify
echo "\n5️⃣ Verifying setup...\n";
passthru('php artisan tinker --execute="echo \'Doctors: \' . \App\Models\Doctor::count() . PHP_EOL;"');

echo "\n✅ Setup completed!\n";
echo "📝 Test with: patient@test.com / password123\n\n";
