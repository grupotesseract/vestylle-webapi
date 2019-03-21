<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaleConoscosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fale_conoscos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pessoa_id')->nullable()->unsigned();
            $table->string('assunto')->nullable();
            $table->string('mensagem')->nullable();
            $table->string('contato')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fale_conoscos');
    }
}
