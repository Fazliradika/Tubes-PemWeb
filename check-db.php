<?php
/**
 * Database Connection & Table Check Script
 * Use this to verify Railway MySQL connection and tables
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔍 Checking Database Connection...\n\n";

try {
    $pdo = DB::connection()->getPdo();
    echo "✅ Database Connected!\n";
    echo "   Driver: " . DB::connection()->getDriverName() . "\n";
    echo "   Database: " . DB::connection()->getDatabaseName() . "\n\n";
    
    echo "📋 Checking Required Tables...\n\n";
    
    $tables = [
        'users',
        'categories', 
        'products',
        'carts',
        'cart_items',
        'orders',
        'order_items',
        'payments'
    ];
    
    foreach ($tables as $table) {
        try {
            $exists = DB::select("SHOW TABLES LIKE '$table'");
            if (!empty($exists)) {
                $count = DB::table($table)->count();
                echo "   ✅ $table ($count records)\n";
            } else {
                echo "   ❌ $table (NOT FOUND - Run migrations!)\n";
            }
        } catch (Exception $e) {
            echo "   ❌ $table (Error: " . $e->getMessage() . ")\n";
        }
    }
    
    echo "\n📊 Users Table Structure:\n";
    try {
        $columns = DB::select("DESCRIBE users");
        foreach ($columns as $column) {
            echo "   - {$column->Field} ({$column->Type}) " . 
                 ($column->Null == 'YES' ? 'NULL' : 'NOT NULL') . 
                 ($column->Key == 'PRI' ? ' PRIMARY KEY' : '') . "\n";
        }
    } catch (Exception $e) {
        echo "   ❌ Cannot describe users table: " . $e->getMessage() . "\n";
    }
    
    echo "\n✨ Database check complete!\n";
    
} catch (Exception $e) {
    echo "❌ Database Connection Failed!\n";
    echo "   Error: " . $e->getMessage() . "\n\n";
    echo "💡 Solutions:\n";
    echo "   1. Check .env file has correct Railway MySQL credentials\n";
    echo "   2. Verify MYSQLHOST, MYSQLPORT, MYSQLDATABASE, MYSQLUSER, MYSQLPASSWORD\n";
    echo "   3. Make sure Railway MySQL service is running\n";
    echo "   4. Run: php artisan config:clear\n";
}
