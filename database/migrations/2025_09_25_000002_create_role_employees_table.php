<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_employees', function (Blueprint $table) {
            $table->integer('emp_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->primary(['emp_id','role_id']);

            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_employees', function (Blueprint $table) {
            $table->dropForeign(['emp_id']);
            $table->dropForeign(['role_id']);
        });
        Schema::dropIfExists('role_employees');
    }
}
