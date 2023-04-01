<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUjianPeserta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_peserta', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('ujian_id');
            $table->unsignedBigInteger('peserta_id');

            $table->index(['ujian_id']);
            $table->foreign('ujian_id')
            ->references('id')
            ->on('ujian')
            ->constrained()
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->index(['peserta_id']);
            $table->foreign('peserta_id')
            ->references('id')
            ->on('peserta')
            ->constrained()
            ->onUpdate('restrict')
            ->onDelete('restrict');


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
        Schema::dropIfExists('ujian_peserta');
    }
}
