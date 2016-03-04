<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 100);
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->text('tags')->nullable();
            $table->integer('category_id');
            $table->integer('supplier_id');
            $table->timestamps();

            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
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
        Schema::drop('products');
    }
}
