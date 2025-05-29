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
        Schema::table('devices', function (Blueprint $table) {
            $table->unsignedBigInteger('device_group_id')->nullable()->after('id');
            $table->foreign('device_group_id')->references('id')->on('device_groups')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['device_group_id']);
            $table->dropColumn('device_group_id');
        });
    }
    
};
