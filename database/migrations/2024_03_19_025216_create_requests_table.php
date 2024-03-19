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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title');
            $table->string('description');
            $table->date('close_at');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('priority_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('college_id');
            $table->unsignedBigInteger('file_path_id');


            $table->foreign('room_id')->references('id')
            ->on('rooms')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('status_id')->references('id')
            ->on('request_statuses')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('priority_id')->references('id')
            ->on('priorities')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('category_id')->references('id')
            ->on('categories')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('college_id')->references('id')
            ->on('colleges')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('file_path_id')->references('id')
            ->on('file_paths')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
