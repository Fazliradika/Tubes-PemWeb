<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('specialization'); // Spesialis, Dokter Umum, dll
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->decimal('price_per_session', 10, 2); // Harga per sesi
            $table->integer('years_of_experience')->default(0);
            $table->json('available_days'); // ["Monday", "Tuesday", "Wednesday"]
            $table->time('start_time'); // Jam mulai praktik
            $table->time('end_time'); // Jam selesai praktik
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
