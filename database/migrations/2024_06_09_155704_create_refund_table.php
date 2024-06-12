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
        Schema::create('refund', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount_refund');
            $table->timestamp('refund_date')->nullable();
            $table->enum('status',['Requested', 'Approved', 'Rejected']);
            $table->unsignedBigInteger('pesanan_id');
            $table->timestamps();

            //Foreign keys
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
        Schema::dropIfExists('refund');
    }
};
