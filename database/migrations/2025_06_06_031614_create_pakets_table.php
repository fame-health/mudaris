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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->enum('category', ['regular', 'vip', 'family'])->default('regular');
            $table->boolean('is_featured')->default(false);
            $table->string('image_path')->nullable();
            $table->json('features')->nullable();
            $table->date('departure_date')->nullable(); // Diubah dari departure_schedule
            $table->text('departure_schedule')->nullable(); // Untuk menyimpan jadwal keberangkatan (text)
            $table->integer('hotel_rating')->nullable()->between(1, 5);
            $table->text('meals_description')->nullable();
            $table->json('inclusions')->nullable();
            $table->json('exclusions')->nullable();
            $table->integer('duration_days')->default(1);
            $table->enum('status', ['active', 'inactive', 'coming_soon'])->default('active'); // Ditambahkan opsi coming_soon
            $table->timestamps();
            $table->softDeletes();

            // Tambahkan index untuk kolom yang sering dicari
            $table->index('category');
            $table->index('status');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
