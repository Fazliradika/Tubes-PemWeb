<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * ⚠️ SECURITY WARNING: This seeder creates an admin with default password.
     * ALWAYS change this password immediately after deployment!
     * Default password: 'password123'
     */
    public function run(): void
    {
        // Check if admin exists
        $admin = User::where('email', 'admin@example.com')->first();
        
        if ($admin) {
            // Update existing admin
            $admin->update([
                'name' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ]);
            
            $this->command->info('Admin user updated successfully!');
        } else {
            // Create new admin
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('Admin user created successfully!');
        }
        
        // Display admin info
        $admin = User::where('email', 'admin@example.com')->first();
        $this->command->table(
            ['ID', 'Name', 'Email', 'Role'],
            [[$admin->id, $admin->name, $admin->email, $admin->role]]
        );
    }
}
