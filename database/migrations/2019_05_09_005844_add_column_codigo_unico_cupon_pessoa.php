<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCodigoUnicoCuponPessoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cupons_pessoas', function(Blueprint $table) {
            // Essa length 9 é em virtude o formato do código: #xxxxxxxx
            $table->string('codigo_unico', 9)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('cupons_pessoas', 'codigo_unico')) {
            Schema::table('cupons_pessoas', function(Blueprint $table) {
                $table->dropColumn('codigo_unico');
            });
        }
    }
}
