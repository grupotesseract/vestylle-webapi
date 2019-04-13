<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segmentacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->nullable();
            $table->string('owner_type')->nullable();

            $table->integer('categoria_id')->nullable()->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('segmentacoes');
    }
}
