<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTituloSubtituloCupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cupons', function(Blueprint $table) {
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
        $hasTituloColumn = Schema::hasColumn('cupons', 'titulo');
        $hasSubtituloColumn = Schema::hasColumn('cupons', 'subtitulo');

        $hasColumns = $hasTituloColumn and $hasSubtituloColumn;

        if ($hasColumns) {
            Schema::table('cupons', function(Blueprint $table) {
                $table->dropColumn('titulo');
                $table->dropColumn('subtitulo');
            });
        }
    }
}
