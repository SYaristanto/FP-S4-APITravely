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
        Schema::create('kursi', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('travel_id');
            $table->foreignId('travel_id')->constrained('informasi_travel')->onDelete('cascade');
            $table->integer('seat_number');
            $table->string('status')->default('tersedia');
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
        Schema::dropIfExists('kursi');
    }
};
