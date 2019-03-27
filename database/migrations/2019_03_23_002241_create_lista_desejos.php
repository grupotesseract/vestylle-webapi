<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaDesejos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_desejos', function (Blueprint $table) {
            $table->increments('id');

            //FK da pessoa que favoritou
            $table->integer('pessoa_id')->nullable()->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');

            //FK da oferta favoritada
            $table->integer('oferta_id')->nullable()->unsigned();
            $table->foreign('oferta_id')->references('id')->on('ofertas');

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
        Schema::dropIfExists('lista_desejos');
    }
}
