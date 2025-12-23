<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update photos for ALL doctors to ensure no duplicates
        $doctorPhotoUpdates = [
            // Row 1
            [
                'email' => 'doctor@healthfirst.com',
                'photo' => 'https://images.unsplash.com/photo-1666214280557-f1b5022eb634?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            [
                'email' => 'citra.dewi@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1638202993928-7267aad84c31?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            // Row 2
            [
                'email' => 'sarah.wijaya@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            // Row 3
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
