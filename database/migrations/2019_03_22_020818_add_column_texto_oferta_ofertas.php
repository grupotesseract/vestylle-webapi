<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTextoOfertaOfertas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ofertas', function(Blueprint $table) {
            $table->text('texto_oferta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('ofertas', 'texto_oferta')) {
            Schema::table('ofertas', function(Blueprint $table) {
                $table->dropColumn('texto_oferta');
            });
        }
    }
}
