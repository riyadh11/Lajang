<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePertanggungJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanggung-jawabans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('laporan')->unsigned();
            $table->text('keterangan');
            $table->text('kendala');
            $table->text('solusi');
            $table->integer('administrator')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertanggung-jawabans');
    }
}
