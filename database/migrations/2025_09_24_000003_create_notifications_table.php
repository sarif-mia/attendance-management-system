<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateNotificationsTable extends Migration {
    public function up() {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }
    public function down() {
        Schema::dropIfExists('notifications');
    }
}
