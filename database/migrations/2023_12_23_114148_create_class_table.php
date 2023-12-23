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
        Schema::create('class', function (Blueprint $table) {
            $table->increments('class_id');
            $table->string('board_id');
            $table->string('medium_id');
            $table->string('class_name');
            $table->string('class_description');
            $table->string('class_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class');
    }
};
