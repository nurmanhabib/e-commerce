<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->text('address_line_1');
            $table->text('address_line_2')->nullable();
            $table->string('phone_1', 14);
            $table->string('phone_2', 14)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('tags');
            $table->timestamps();
        });

        Schema::create('user_suplier', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('suplier_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('supliers');
        Schema::drop('user_suplier');
    }
}