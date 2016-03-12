<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('address_line_1', 100)->nullable();
            $table->string('address_line_2', 200)->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('phone_number', 14)->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shipping_addresses');
    }
}
