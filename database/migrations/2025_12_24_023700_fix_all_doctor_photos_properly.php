<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     * Replace ALL doctor photos with proper professional images
     */
    public function up(): void
    {
        // All 9 doctors with proper professional photos matching gender
        $doctorPhotoUpdates = [
            // MALE DOCTORS (5)
            [
                'email' => 'doctor@healthfirst.com', // Dr. Health First - Dokter Umum (Male)
                'photo' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face'
            ],
            [
                'email' => 'ahmad.fadli@hospital.com', // Dr. Ahmad Fadli - Kardiologi (Male)
                'photo' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=400&h=400&fit=crop&crop=face'
            ],
            [
                'email' => 'budi.santoso@hospital.com', // Dr. Budi Santoso - Dokter Umum (Male)
                'photo' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=400&h=400&fit=crop&crop=face'
            ],
            [
                'email' => 'rudi.hermawan@hospital.com', // Dr. Rudi Hermawan - Orthopedi (Male)
                'photo' => 'https://images.unsplash.com/photo-1618498082410-b4aa22193b38?w=400&h=400&fit=crop&crop=face'
            ],
            [
                'email' => 'andri.pratama@hospital.com', // Dr. Andri Pratama - Psikiater (Male)
                'photo' => 'https://images.unsplash.com/photo-1607990281513-2c110a25bd8c?w=400&h=400&fit=crop&crop=face'
            ],
            // FEMALE DOCTORS (4)
            [
                'email' => 'citra.dewi@hospital.com', // Dr. Citra Dewi - Dermatologi (Female)
                'photo' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop&crop=face'
            ],
            [
                'email' => 'sarah.wijaya@hospital.com', // Dr. Sarah Wijaya - Pediatri (Female)
                'photo' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face'
            ],
            [
                'email' => 'linda.kusuma@hospital.com', // Dr. Linda Kusuma - Dokter Gigi (Female)
                'photo' => 'https://images.unsplash.com/photo-1651008376811-b90baee60c1f?w=400&h=400&fit=crop&crop=face'
            ],
            [
                'email' => 'maya.sari@hospital.com', // Dr. Maya Sari - Obstetri & Ginekologi (Female)
                'photo' => 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?w=400&h=400&fit=crop&crop=face'
            ],
        ];

        foreach ($doctorPhotoUpdates as $update) {
            $user = DB::table('users')->where('email', $update['email'])->first();

            if ($user) {
                DB::table('doctors')
                    ->where('user_id', $user->id)
                    ->update(['photo' => $update['photo']]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse photo updates
    }
};
