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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            // $table->string('nama_pemesan');
            $table->intenger('no_pesanan');
            $table->string('nama_penumpang');
            $table->string('total_harga');
            $table->date('tanggal_pemesanan');
            $table->enum('status_pesanan',['Pending', 'Confirmed', 'Cancelled']);
            // $table->unsignedBigInteger('user_id');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
};
