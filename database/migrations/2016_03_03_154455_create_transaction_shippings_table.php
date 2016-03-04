<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('address_line_1', 100)->nullable();
            $table->string('address_line_2', 200)->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('phone', 14)->nullable();
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
        Schema::drop('transaction_shippings');
    }
}
