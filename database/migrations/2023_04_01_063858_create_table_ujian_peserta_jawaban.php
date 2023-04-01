<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUjianPesertaJawaban extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_peserta_jawaban', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ujian_peserta_id');
            $table->index(['ujian_peserta_id']);
            $table->foreign('ujian_peserta_id')
            ->references('id')
            ->on('ujian_peserta')
            ->constrained()
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->unsignedBigInteger('soal_id');
            $table->index(['soal_id']);
            $table->foreign('soal_id')
            ->references('id')
            ->on('soal')
            ->constrained()
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->unsignedBigInteger('id_soal_opsi_kunci_jawaban')->nullable();
            $table->unsignedBigInteger('id_soal_opsi_jawaban')->nullable();
            $table->tinyInteger('nilai')->nullable()->default(0);

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
        Schema::dropIfExists('ujian_peserta_jawaban');
    }
}
