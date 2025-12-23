<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     * Force update all doctor photos to ensure unique faces
     */
    public function up(): void
    {
        // Update ALL 9 doctors with correct photos
        $doctorPhotoUpdates = [
            // Keep existing photos for these doctors
            [
                'email' => 'ahmad.fadli@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=400&h=400&fit=crop'
            ],
            [
                'email' => 'budi.santoso@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=400&h=400&fit=crop'
            ],
            [
                'email' => 'rudi.hermawan@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1651008376811-b90baee60c1f?w=400&h=400&fit=crop'
            ],
            // Update these 6 doctors with NEW unique photos
            [
                'email' => 'doctor@healthfirst.com',
                'photo' => 'https://images.unsplash.com/photo-1666214280557-f1b5022eb634?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            [
                'email' => 'citra.dewi@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1638202993928-7267aad84c31?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            [
                'email' => 'sarah.wijaya@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            [
                'email' => 'linda.kusuma@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            [
                'email' => 'andri.pratama@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1622902046580-2b47f47f5471?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            [
                'email' => 'maya.sari@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
        ];

        foreach ($doctorPhotoUpdates as $update) {
            // Find user by email
            $user = DB::table('users')->where('email', $update['email'])->first();

            if ($user) {
                // Update doctor photo
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
