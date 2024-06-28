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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('armada');
<<<<<<< HEAD
            $table->string('plat_nomor');
            $table->string('jumlah_kursi');
=======
            // $table->string('jenis_kendaraan');
            $table->string('plat_nomor');
            // $table->string('jumlah_kursi');
            $table->string('kapasitas');
>>>>>>> 3abdc52060f516629b09aaa45d580524b6197167
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
        Schema::dropIfExists('kendaraan');
    }
};
