<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurierPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curier_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45);
            $table->string('name', 45);
            $table->integer('curier_id');
            $table->timestamps();

            $table->foreign('curier_id')
                ->references('id')->on('curiers')
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
        Schema::drop('curier_packages');
    }
}
