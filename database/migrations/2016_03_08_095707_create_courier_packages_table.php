<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourierPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45);
            $table->string('name', 45);
            $table->integer('courier_id');
            $table->timestamps();

            $table->foreign('courier_id')
                ->references('id')->on('couriers')
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
        Schema::drop('courier_packages');
    }
}
