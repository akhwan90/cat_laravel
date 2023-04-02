<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSoalAddIdMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soal', function (Blueprint $table) {

            $table->unsignedBigInteger('mapel_id');
            $table->index(['mapel_id']);
            $table->foreign('mapel_id')
                ->references('id')
                ->on('mapel')
                ->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
