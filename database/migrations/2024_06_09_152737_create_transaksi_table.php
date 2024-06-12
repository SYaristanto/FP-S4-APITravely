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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transaksi');
            $table->string('metode_pembayaran');
            $table->string('total');
            $table->string('refund_status');
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('pesanan_id');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('pesanan_id')->references('id')->on('pesanan')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
