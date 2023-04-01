<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSoalOpsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_opsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soal_id');
            
            $table->string('opsi', 512)->nullable();
            $table->string('file_media', 128)->nullable();
            $table->string('file_media_type', 128)->nullable();
            $table->smallInteger('is_kunci')->nullable()->default(0);

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
        Schema::dropIfExists('soal_opsi');
    }
}
