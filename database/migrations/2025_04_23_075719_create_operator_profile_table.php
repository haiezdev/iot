<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('operator_profile', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('profile_id');
        $table->unsignedBigInteger('operator_id'); // FK đến users table
        $table->timestamps();

        $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        $table->foreign('operator_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operator_profile');
    }
};
