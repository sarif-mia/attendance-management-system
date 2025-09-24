<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePayrollsTable extends Migration {
    public function up() {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('salary', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('loan', 10, 2)->default(0);
            $table->string('month');
            $table->string('year');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('payrolls');
    }
}
