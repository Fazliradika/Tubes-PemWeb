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
                'photo' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.4'
            ],
            [
                'email' => 'citra.dewi@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.4'
            ],
            // Row 2
            [
                'email' => 'sarah.wijaya@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1614608682850-e0d6ed316d47?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.4'
            ],
            // Row 3
            [
                'email' => 'linda.kusuma@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.4'
            ],
            [
                'email' => 'andri.pratama@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.4'
            ],
            [
                'email' => 'maya.sari@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.4'
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
