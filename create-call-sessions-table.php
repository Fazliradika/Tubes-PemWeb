#!/usr/bin/env php
<?php

// Create call_sessions table migration
$output = shell_exec('php artisan migrate --path=database/migrations/2025_11_29_000001_create_call_sessions_table.php --force 2>&1');
echo "Migration Output:\n";
echo $output;
echo "\n";

// Verify table exists
try {
    $pdo = new PDO(
        'mysql:host=' . getenv('MYSQLHOST') . ';port=' . getenv('MYSQLPORT') . ';dbname=' . getenv('MYSQLDATABASE'),
        getenv('MYSQLUSER'),
        getenv('MYSQLPASSWORD')
    );
    
    $stmt = $pdo->query("SHOW COLUMNS FROM call_sessions");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\nTable 'call_sessions' columns:\n";
    foreach ($columns as $column) {
        echo "- {$column['Field']} ({$column['Type']})\n";
    }
    
    echo "\n✅ Migration successful!\n";
} catch (PDOException $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
}
