<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject', 100)->nullable();
            $table->string('testimonial', 140)->nullable();
            $table->tinyInteger('point_speed')->default(1);
            $table->tinyInteger('point_quality')->default(1);
            $table->tinyInteger('point_package')->default(1);
            $table->integer('product_id');
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
        Schema::drop('testimonials');
    }
}
