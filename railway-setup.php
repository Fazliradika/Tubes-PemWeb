#!/usr/bin/env php
<?php
/**
 * Production Setup Script for Railway
 * This will run migrations and seeders if needed
 */

echo "🚀 Starting Production Setup...\n\n";

// Check if we're in production
if (getenv('APP_ENV') !== 'production') {
    echo "⚠️  Warning: APP_ENV is not 'production'\n";
    echo "   Current: " . (getenv('APP_ENV') ?: 'not set') . "\n\n";
}

$commands = [
    'Clear Cache' => 'php artisan config:clear',
    'Cache Config' => 'php artisan config:cache',
    'Run Migrations' => 'php artisan migrate --force',
    'Seed Database' => 'php artisan db:seed --force',
    'Storage Link' => 'php artisan storage:link',
    'Clear Routes' => 'php artisan route:clear',
    'Cache Routes' => 'php artisan route:cache',
];

foreach ($commands as $name => $command) {
    echo "📦 $name...\n";
    echo "   Running: $command\n";
    
    $output = [];
    $returnCode = 0;
    exec($command . ' 2>&1', $output, $returnCode);
    
    if ($returnCode === 0) {
        echo "   ✅ Success\n";
        if (!empty($output)) {
            foreach ($output as $line) {
                echo "      $line\n";
            }
        }
    } else {
        echo "   ⚠️  Warning (exit code: $returnCode)\n";
        foreach ($output as $line) {
            echo "      $line\n";
        }
    }
    echo "\n";
}

echo "✨ Production setup complete!\n";
echo "🌐 Your app should be ready at: " . (getenv('APP_URL') ?: 'your-domain') . "\n";
