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
        Schema::create('file_paths', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->unsignedBigInteger('tracking_id')->nullable();
            $table->unsignedBigInteger('request_id')->nullable();

            $table->foreign('tracking_id')->references('id')
            ->on('trackings')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('request_id')->references('id')
            ->on('requests')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_paths');
    }
};