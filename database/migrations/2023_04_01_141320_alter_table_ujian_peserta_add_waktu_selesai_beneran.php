<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUjianPesertaAddWaktuSelesaiBeneran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujian_peserta', function (Blueprint $table) {
            $table->dateTime('selesai_dikerjakan_sebenarnya')->nullable();
            $table->tinyInteger('nilai')->nullable()->default(0);
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
