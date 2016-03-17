<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_confirmations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank_name', 45);
            $table->string('sender_name', 45);
            $table->integer('nominal');
            $table->integer('invoice_id');
            $table->timestamps();

            $table->foreign('invoice_id')
                    ->references('id')->on('invoices')
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
        Schema::drop('payment_confirmations');
    }
}
