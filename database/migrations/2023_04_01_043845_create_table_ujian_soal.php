<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUjianSoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_soal', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ujian_id');
            $table->index(['ujian_id']);
            $table->foreign('ujian_id')
            ->references('id')
            ->on('ujian')
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
        Schema::dropIfExists('ujian_soal');
    }
}
