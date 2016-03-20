<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');

            $table->integer('object_id')->nullable();
            $table->string('object_type')->nullable();

            $table->integer('sender_id')->nullable();
            $table->string('sender_type')->nullable();

            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('user_notification', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notification_id');
            $table->unsignedInteger('user_id');
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('notification_id')
                ->references('id')->on('notifications')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_notification');
        Schema::drop('notifications');
    }
}
