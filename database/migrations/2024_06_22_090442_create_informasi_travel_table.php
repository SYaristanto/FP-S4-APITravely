<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_travel', function (Blueprint $table) {
            $table->id();
            $table->string('keberangkatan');
            $table->string('tujuan');
            $table->date('tanggal_keberangkatan');
            $table->time('jam_keberangkatan');
            $table->string('kursi_tersedia');
            $table->unsignedBigInteger('kendaraan_id');
            $table->unsignedBigInteger('rute_id');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan')->onDelete('cascade')->onUpdate('no action');
            $table->foreign('rute_id')->references('id')->on('rute')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasi_travel');
    }
};
