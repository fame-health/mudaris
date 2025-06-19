<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            // Tambah kolom image_path jika belum ada
            if (!Schema::hasColumn('media', 'image_path')) {
                $table->string('image_path')->nullable()->after('alt_text');
            }

            // Tambah kolom is_featured jika belum ada
            if (!Schema::hasColumn('media', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('is_active');
            }
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn(['image_path', 'is_featured']);
        });
    }
};


