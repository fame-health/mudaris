<?php

// 1. Migration
// database/migrations/create_page_visitors_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('page_visitors', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->integer('visit_count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_visitors');
    }
};
