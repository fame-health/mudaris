<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_galleries_table.php

public function up(): void
{
    Schema::create('galleries', function (Blueprint $table) {
        $table->id();
        $table->string('image'); // path gambar
        $table->string('title');
        $table->string('location')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
