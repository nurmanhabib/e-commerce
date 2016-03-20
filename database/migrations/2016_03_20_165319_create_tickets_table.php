<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45)->unique();
            $table->string('subject');
            $table->text('content');
            $table->string('status');
            $table->unsignedInteger('ticket_department_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('ticket_department_id')
                ->references('id')->on('ticket_departments')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->text('content');
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('ticket_id')
                ->references('id')->on('tickets')
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
        Schema::drop('ticket_replies');
        Schema::drop('tickets');
        Schema::drop('ticket_departments');
    }
}
