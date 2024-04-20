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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->date('enddate')->nullable();
            $table->string('details');
            $table->string('subject');
            $table->unsignedBigInteger('request_id');
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');

            $table->foreign('from_user_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('set null');

            $table->foreign('to_user_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('set null');

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
        Schema::dropIfExists('trackings');
    }
};
