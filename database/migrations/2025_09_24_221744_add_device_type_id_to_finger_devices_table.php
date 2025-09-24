<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeviceTypeIdToFingerDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finger_devices', function (Blueprint $table) {
            $table->unsignedBigInteger('device_type_id')->nullable();
            $table->foreign('device_type_id')->references('id')->on('device_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finger_devices', function (Blueprint $table) {
            $table->dropForeign(['device_type_id']);
            $table->dropColumn('device_type_id');
        });
    }
}
