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
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('subject_id');
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('medium_id')->references('medium_id')->on('mediums');
            $table->foreign('class_id')->references('class_id')->on('class');
            $table->string('subject_name');
            $table->string('subject_description');
            $table->string('subject_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
