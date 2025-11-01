<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating Admin User...');

        $name = $this->ask('Enter admin name', 'Admin');
        $email = $this->ask('Enter admin email', 'admin@example.com');
        $password = $this->secret('Enter admin password');
        
        if (!$password) {
            $password = 'password';
            $this->warn('No password provided, using default: password');
        }

        // Check if user already exists
        if (User::where('email', $email)->exists()) {
            $this->error('User with this email already exists!');
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'phone' => $this->ask('Enter phone number (optional)', null),
            'email_verified_at' => now(),
        ]);

        $this->info('Admin user created successfully!');
        $this->newLine();
        $this->table(
            ['Field', 'Value'],
            [
                ['Name', $user->name],
                ['Email', $user->email],
                ['Role', $user->role],
                ['Password', '(hidden)'],
            ]
        );

        return 0;
    }
}
