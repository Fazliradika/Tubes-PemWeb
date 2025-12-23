<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update photos for 3 doctors with incorrect images
        $doctorPhotoUpdates = [
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
