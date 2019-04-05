<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLojasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lojas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cor_primaria')->nullable();
            $table->string('cor_secundaria')->nullable();
            $table->string('cor_terciaria')->nullable();
            $table->string('endereco')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telefone')->nullable();
            $table->string('horario_funcionamento')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lojas');
    }
}
