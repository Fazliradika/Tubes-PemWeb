<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PatientTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test patient account
        User::firstOrCreate(
            ['email' => 'patient@test.com'],
            [
                'name' => 'Test Patient',
                'password' => Hash::make('password123'),
                'role' => 'patient',
                'phone' => '081234567890',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Patient test account created!');
        $this->command->info('Email: patient@test.com');
        $this->command->info('Password: password123');
    }
}
