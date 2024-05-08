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
        Schema::create('user_type_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_type_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_type_permissions');
    }
};
