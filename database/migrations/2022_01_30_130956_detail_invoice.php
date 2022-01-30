<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('samp_id')->nullable();
            $table->unsignedBigInteger('prod_id')->nullable();
            $table->unsignedSmallInteger('qty');
            $table->text('ket');
            $table->mediumInteger('harga');
            $table->mediumInteger('total');
            $table->timestamps();
            $table->foreign('samp_id')->references('id')->on('sampling');
            $table->foreign('prod_id')->references('id')->on('produksi');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_invoice');
    }
}
