<?php



use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;



class CreateFingerDevicesTable extends Migration

{

    public function up()

    {

        Schema::create('finger_devices', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->ipAddress('ip');
            $table->string('serialNumber')->unique();
            $table->unsignedBigInteger('device_type_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('device_type_id')->references('id')->on('device_types');
        });

    }



    public function down()

    {

        Schema::dropIfExists('finger_devices');

    }

}

