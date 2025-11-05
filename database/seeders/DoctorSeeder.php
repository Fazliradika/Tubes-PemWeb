<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create doctor users and their doctor profiles
        $doctors = [
            [
                'name' => 'Dr. Ahmad Fadli',
                'email' => 'ahmad.fadli@hospital.com',
                'specialization' => 'Kardiologi',
                'bio' => 'Spesialis jantung dengan pengalaman lebih dari 10 tahun dalam menangani berbagai penyakit jantung dan pembuluh darah.',
                'price_per_session' => 350000,
                'years_of_experience' => 10,
                'available_days' => ['Monday', 'Wednesday', 'Friday'],
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'name' => 'Dr. Citra Dewi',
                'email' => 'citra.dewi@hospital.com',
                'specialization' => 'Dermatologi',
                'bio' => 'Ahli kulit dan kelamin yang berpengalaman dalam menangani masalah kulit, rambut, dan kecantikan.',
                'price_per_session' => 300000,
                'years_of_experience' => 8,
                'available_days' => ['Tuesday', 'Thursday', 'Saturday'],
                'start_time' => '10:00:00',
                'end_time' => '18:00:00',
            ],
            [
                'name' => 'Dr. Budi Santoso',
                'email' => 'budi.santoso@hospital.com',
                'specialization' => 'Dokter Umum',
                'bio' => 'Dokter umum yang siap membantu Anda dengan berbagai keluhan kesehatan sehari-hari.',
                'price_per_session' => 150000,
                'years_of_experience' => 5,
                'available_days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'start_time' => '08:00:00',
                'end_time' => '20:00:00',
            ],
            [
                'name' => 'Dr. Sarah Wijaya',
                'email' => 'sarah.wijaya@hospital.com',
                'specialization' => 'Pediatri',
                'bio' => 'Spesialis anak yang berpengalaman dalam merawat kesehatan anak dari bayi hingga remaja.',
                'price_per_session' => 250000,
                'years_of_experience' => 7,
                'available_days' => ['Monday', 'Wednesday', 'Friday', 'Saturday'],
                'start_time' => '09:00:00',
                'end_time' => '16:00:00',
            ],
            [
                'name' => 'Dr. Rudi Hermawan',
                'email' => 'rudi.hermawan@hospital.com',
                'specialization' => 'Orthopedi',
                'bio' => 'Spesialis tulang dan sendi, ahli dalam menangani cedera olahraga dan masalah muskuloskeletal.',
                'price_per_session' => 400000,
                'years_of_experience' => 12,
                'available_days' => ['Tuesday', 'Thursday'],
                'start_time' => '10:00:00',
                'end_time' => '15:00:00',
            ],
            [
                'name' => 'Dr. Linda Kusuma',
                'email' => 'linda.kusuma@hospital.com',
                'specialization' => 'Dokter Gigi',
                'bio' => 'Dokter gigi profesional yang menangani perawatan gigi dan mulut dengan teknologi modern.',
                'price_per_session' => 200000,
                'years_of_experience' => 6,
                'available_days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'name' => 'Dr. Andri Pratama',
                'email' => 'andri.pratama@hospital.com',
                'specialization' => 'Psikiater',
                'bio' => 'Spesialis kesehatan mental yang membantu menangani berbagai gangguan psikologis dan emosional.',
                'price_per_session' => 350000,
                'years_of_experience' => 9,
                'available_days' => ['Monday', 'Wednesday', 'Friday'],
                'start_time' => '13:00:00',
                'end_time' => '20:00:00',
            ],
            [
                'name' => 'Dr. Maya Sari',
                'email' => 'maya.sari@hospital.com',
                'specialization' => 'Obstetri & Ginekologi',
                'bio' => 'Spesialis kandungan dan kebidanan yang berpengalaman dalam kehamilan dan kesehatan wanita.',
                'price_per_session' => 300000,
                'years_of_experience' => 11,
                'available_days' => ['Tuesday', 'Thursday', 'Saturday'],
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
            ],
        ];

        foreach ($doctors as $doctorData) {
            // Create user account for doctor
            $user = User::create([
                'name' => $doctorData['name'],
                'email' => $doctorData['email'],
                'password' => Hash::make('password123'),
                'role' => 'doctor',
                'phone' => '08' . rand(1000000000, 9999999999),
                'email_verified_at' => now(),
            ]);

            // Create doctor profile
            Doctor::create([
                'user_id' => $user->id,
                'specialization' => $doctorData['specialization'],
                'bio' => $doctorData['bio'],
                'price_per_session' => $doctorData['price_per_session'],
                'years_of_experience' => $doctorData['years_of_experience'],
                'available_days' => $doctorData['available_days'],
                'start_time' => $doctorData['start_time'],
                'end_time' => $doctorData['end_time'],
                'is_active' => true,
            ]);
        }

        $this->command->info('Doctor seeder completed successfully!');
    }
}
