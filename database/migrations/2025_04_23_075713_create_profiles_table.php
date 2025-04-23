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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('device_group_id');
            $table->unsignedBigInteger('command_list_id');
            $table->text('description')->nullable();
            $table->timestamps();
    
            $table->foreign('device_group_id')->references('id')->on('device_groups')->onDelete('cascade');
            $table->foreign('command_list_id')->references('id')->on('command_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
