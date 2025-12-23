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
                'photo' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            [
                'email' => 'andri.pratama@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
            ],
            [
                'email' => 'maya.sari@hospital.com',
                'photo' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=focalpoint&fp-y=0.35'
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
