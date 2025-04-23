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
    Schema::create('devices', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('ip_address');
        $table->boolean('status')->default(false); // 1: active, 0: inactive
        $table->unsignedBigInteger('device_group_id')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();

        $table->foreign('device_group_id')->references('id')->on('device_groups')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
