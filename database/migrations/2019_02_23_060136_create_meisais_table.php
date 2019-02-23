<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeisaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meisais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->integer('zankai');
            $table->integer('zangaku');
            $table->string('hikibi');
            $table->integer('heisaigaku');
            $table->integer('heisaimoto');
            $table->integer('suerisoku');
            $table->integer('risoku');
            $table->integer('hasu');
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
        Schema::dropIfExists('meisais');
    }
}
