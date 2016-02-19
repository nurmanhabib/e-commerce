<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('address_line_1', 100);
            $table->string('address_line_2', 200);
            $table->string('postal_code', 5);
            $table->string('city', 100);
            $table->string('phone', 14);
            $table->integer('user_id');
            $table->timestamps();

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
        Schema::drop('shipping_address');
    }
}
