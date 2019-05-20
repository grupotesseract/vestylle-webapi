<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTituloSubtituloPrecoOfertas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ofertas', function(Blueprint $table) {
            $table->string('titulo', 150)->nullable();
            $table->string('subtitulo', 150)->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $hasTituloColumn = Schema::hasColumn('ofertas', 'titulo');
        $hasSubtituloColumn = Schema::hasColumn('ofertas', 'subtitulo');
        $hasPrecoColumn = Schema::hasColumn('ofertas', 'preco');

        $hasColumns = $hasTituloColumn and $hasSubtituloColumn and $hasPrecoColumn;

        if ($hasColumns) {
            Schema::table('ofertas', function(Blueprint $table) {
                $table->dropColumn('titulo');
                $table->dropColumn('subtitulo');                
            });
        }
    }
}
