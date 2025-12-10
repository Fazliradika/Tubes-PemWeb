<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * ⚠️ SECURITY WARNING: This seeder creates users with weak default passwords.
     * ALWAYS change ALL user passwords in production environments immediately after deployment!
     */
    public function run(): void
    {
        $this->command->info('🌱 Seeding Users...');
        $this->command->warn('⚠️  Using default passwords - CHANGE THESE IN PRODUCTION!');
        
        // Create Admin Users
        $admins = [
            ['name' => 'Admin Health First', 'email' => 'admin@healthfirst.com', 'password' => 'password'],
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => 'password123'],
            ['name' => 'Admin Health First Medical', 'email' => 'admin@healthfirstmedical.com', 'password' => 'password'],
            ['name' => 'Super Admin', 'email' => 'superadmin@example.com', 'password' => 'password'],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']], // Find by email
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'role' => 'admin',
                    'email_verified_at' => now(),
                    'created_at' => now()->subDays(rand(200, 365)),
                    'updated_at' => now()->subDays(rand(0, 10)),
                ]
            );
        }
        $this->command->info('✅ Created/Updated ' . count($admins) . ' admins');

        // Create Doctor Users with varied registration dates
        $doctors = [
            ['name' => 'Dr. Health First', 'email' => 'doctor@healthfirst.com', 'specialty' => 'General Practitioner'],
            ['name' => 'Dr. Ahmad Fadli', 'email' => 'ahmad.fadli@hospital.com', 'specialty' => 'Cardiologist'],
            ['name' => 'Dr. Budi Santoso', 'email' => 'budi.santoso@hospital.com', 'specialty' => 'Pediatrician'],
            ['name' => 'Dr. Citra Dewi', 'email' => 'citra.dewi@hospital.com', 'specialty' => 'Dermatologist'],
            ['name' => 'Dr. Dian Pertiwi', 'email' => 'dian.pertiwi@hospital.com', 'specialty' => 'Neurologist'],
            ['name' => 'Dr. Eko Prasetyo', 'email' => 'eko.prasetyo@hospital.com', 'specialty' => 'Orthopedic'],
            ['name' => 'Dr. Fitri Handayani', 'email' => 'fitri.handayani@hospital.com', 'specialty' => 'Ophthalmologist'],
            ['name' => 'Dr. Gani Kurniawan', 'email' => 'gani.kurniawan@hospital.com', 'specialty' => 'General Practitioner'],
            ['name' => 'Dr. Hani Wijaya', 'email' => 'hani.wijaya@hospital.com', 'specialty' => 'Psychiatrist'],
            ['name' => 'Dr. Indra Gunawan', 'email' => 'indra.gunawan@hospital.com', 'specialty' => 'Surgeon'],
            ['name' => 'Dr. Joko Susilo', 'email' => 'joko.susilo@hospital.com', 'specialty' => 'Dentist'],
            ['name' => 'Dr. Kartika Sari', 'email' => 'kartika.sari@hospital.com', 'specialty' => 'Gynecologist'],
            ['name' => 'Dr. Lina Marlina', 'email' => 'lina.marlina@hospital.com', 'specialty' => 'ENT Specialist'],
            ['name' => 'Dr. Michael Chen', 'email' => 'michael.chen@hospital.com', 'specialty' => 'Radiologist'],
            ['name' => 'Dr. Nita Anggraini', 'email' => 'nita.anggraini@hospital.com', 'specialty' => 'Anesthesiologist'],
            ['name' => 'Dr. Omar Abdullah', 'email' => 'omar.abdullah@hospital.com', 'specialty' => 'Urologist'],
        ];

        foreach ($doctors as $index => $doctor) {
            // Distribute doctor registration across 6 months
            $daysAgo = rand(30, 180);
            User::updateOrCreate(
                ['email' => $doctor['email']], // Find by email
                [
                    'name' => $doctor['name'],
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'email_verified_at' => now()->subDays($daysAgo),
                    'created_at' => now()->subDays($daysAgo),
                    'updated_at' => now()->subDays(rand(0, 30)),
                ]
            );
        }
        $this->command->info('✅ Created/Updated ' . count($doctors) . ' doctors');

        // Create Patient Users with realistic distribution
        $patientNames = [
            'Agus Setiawan', 'Bambang Wijaya', 'Cindy Lestari', 'Dewi Kusuma', 'Edi Supriyanto',
            'Farah Diba', 'Guntur Prakoso', 'Hendra Wibowo', 'Ika Putri', 'Jaka Sembung',
            'Kiki Amalia', 'Lisa Maharani', 'Mulyadi Pratama', 'Nina Sari', 'Oka Mahendra',
            'Putri Maharani', 'Qori Sandioriva', 'Rina Susanti', 'Siti Fatimah', 'Tono Wijaya',
            'Umi Kalsum', 'Vina Panduwinata', 'Wawan Setiawan', 'Xena Wulandari', 'Yanti Kusuma',
            'Zainal Abidin', 'Andi Rahman', 'Bella Safira', 'Candra Kirana', 'Dedi Mulyadi',
            'Erni Susilowati', 'Fajar Nugroho', 'Gita Gutawa', 'Hadi Permana', 'Irma Yunita',
            'Johan Sebastian', 'Kartini Muljadi', 'Luthfi Halim', 'Maya Nurmalasari', 'Nanda Rizky',
            'Olivia Nathania', 'Putra Mahendra', 'Qomar Zaman', 'Raka Pradipta', 'Sari Dewi',
            'Taufik Hidayat', 'Udin Sedunia', 'Vera Agustina', 'Willy Dozan', 'Yuda Pratama',
            'Ahmad Zaki', 'Bayu Saputra', 'Clara Gopa', 'Dimas Anggara', 'Eva Arnaz',
            'Farel Prayoga', 'Gisella Anastasia', 'Hafiz Faisal', 'Intan Paramadina', 'Julia Perez',
            'Katon Bagaskara', 'Lesti Kejora', 'Mawar Hitam', 'Novi Kurnia', 'Oscar Lawalata',
            'Prilly Latuconsina', 'Rafi Ahmad', 'Syahrini', 'Titi DJ', 'Ussy Sulistiawaty',
            'Vicky Prasetyo', 'Wulan Guritno', 'Yuni Shara', 'Zaskia Gotik', 'Ariel Noah',
            'Bunga Citra', 'Cita Citata', 'Dewi Sandra', 'Ely Sugigi', 'Fanny Fabriana',
            'Gracia Indri', 'Hotman Paris', 'Iis Dahlia', 'Judika Sihotang', 'Krisdayanti',
            'Luna Maya', 'Maia Estianty', 'Nikita Mirzani', 'Olga Syahputra', 'Pasha Ungu',
        ];

        // Create patients with varied registration dates (more recent registrations)
        
        // First, create a demo patient account
        User::updateOrCreate(
            ['email' => 'patient@healthfirst.com'],
            [
                'name' => 'Demo Patient',
                'password' => Hash::make('password'),
                'role' => 'patient',
                'email_verified_at' => now(),
                'created_at' => now()->subDays(30),
                'updated_at' => now(),
            ]
        );
        $this->command->info('✅ Created demo patient: patient@healthfirst.com');
        
        foreach ($patientNames as $index => $name) {
            // More patients registered recently (last 6 months)
            $daysAgo = $this->getRealisticRegistrationDate($index, count($patientNames));
            $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';
            
            User::updateOrCreate(
                ['email' => $email], // Find by email
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now()->subDays($daysAgo),
                    'created_at' => now()->subDays($daysAgo),
                    'updated_at' => now()->subDays(rand(0, min($daysAgo, 30))),
                ]
            );
        }
        $this->command->info('✅ Created/Updated ' . count($patientNames) . ' patients');

        // Summary
        $this->command->info('');
        $this->command->info('📊 Summary:');
        $this->command->table(
            ['Role', 'Count'],
            [
                ['Admin', User::where('role', 'admin')->count()],
                ['Doctor', User::where('role', 'doctor')->count()],
                ['Patient', User::where('role', 'patient')->count()],
                ['Total', User::count()],
            ]
        );
    }

    /**
     * Get realistic registration date with more recent registrations
     */
    private function getRealisticRegistrationDate($index, $total)
    {
        // 40% registered in last month
        if ($index < $total * 0.4) {
            return rand(1, 30);
        }
        // 30% registered in last 2-3 months
        if ($index < $total * 0.7) {
            return rand(31, 90);
        }
        // 20% registered in last 3-6 months
        if ($index < $total * 0.9) {
            return rand(91, 180);
        }
        // 10% registered more than 6 months ago
        return rand(181, 365);
    }
}
