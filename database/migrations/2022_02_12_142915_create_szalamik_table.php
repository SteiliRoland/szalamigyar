<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSzalamikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('szalamik', function (Blueprint $table) {
            $table->increments('id');
            $table->text('termeknev');
            $table->text('ar');
            $table->integer('alapanyag_id')->unsigned();
            $table->foreign('alapanyag_id')->references('id')->on('alapanyagok');
            $table->date('gyartasi_ido');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('szalamik');
    }
}