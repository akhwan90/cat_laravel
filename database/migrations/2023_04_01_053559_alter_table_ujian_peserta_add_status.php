<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUjianPesertaAddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujian_peserta', function (Blueprint $table) {
            $table->tinyInteger('status')->nullable()->comment("0: default, 1: dikerjakan, 2: selesai")->default(0);
            $table->dateTime('mulai_dikerjakan')->nullable();
            $table->dateTime('selesai_dikerjakan')->nullable();
            $table->dateTime('last_activity')->nullable();
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
