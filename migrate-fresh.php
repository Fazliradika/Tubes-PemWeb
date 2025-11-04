#!/usr/bin/env php
<?php
/**
 * Railway Migration Fresh Script
 * WARNING: This will DROP all tables and recreate them!
 * Use only for fixing migration issues in development/staging
 */

echo "⚠️  WARNING: This will DROP ALL TABLES!\n";
echo "This script will run: php artisan migrate:fresh --force\n\n";

if (getenv('APP_ENV') === 'production') {
    echo "🛑 STOPPED: This script should not be used in production!\n";
    echo "Please use: php artisan migrate --force instead\n";
    exit(1);
}

echo "🔄 Running migrate:fresh...\n\n";

$output = [];
$returnCode = 0;
exec('php artisan migrate:fresh --force 2>&1', $output, $returnCode);

foreach ($output as $line) {
    echo $line . "\n";
}

if ($returnCode === 0) {
    echo "\n✅ Migration fresh completed successfully!\n";
    echo "\n📦 Now run seeder to populate data:\n";
    echo "   php artisan db:seed --force\n";
} else {
    echo "\n❌ Migration fresh failed!\n";
    echo "Exit code: $returnCode\n";
}
