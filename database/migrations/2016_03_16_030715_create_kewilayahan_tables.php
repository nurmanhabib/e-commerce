<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKewilayahanTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kewilayahan_provinsi', function (Blueprint $table) {
            $table->string('id', 50);
            $table->string('name');

            $table->primary('id');
        });

        Schema::create('kewilayahan_kabkota', function (Blueprint $table) {
            $table->string('id', 50);
            $table->string('name');
            $table->string('provinsi_id', 50);

            $table->primary('id');
            $table->foreign('provinsi_id')
                    ->references('id')->on('kewilayahan_provinsi')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        Schema::create('kewilayahan_kecamatan', function (Blueprint $table) {
            $table->string('id', 50);
            $table->string('name');
            $table->string('kabkota_id', 50);

            $table->primary('id');
            $table->foreign('kabkota_id')
                    ->references('id')->on('kewilayahan_kabkota')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        Schema::create('kewilayahan_desa', function (Blueprint $table) {
            $table->string('id', 50);
            $table->string('name');
            $table->string('kecamatan_id', 50);

            $table->primary('id');
            $table->foreign('kecamatan_id')
                    ->references('id')->on('kewilayahan_kecamatan')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kewilayahan_desa');
        Schema::drop('kewilayahan_kecamatan');
        Schema::drop('kewilayahan_kabkota');
        Schema::drop('kewilayahan_provinsi');
    }
}
