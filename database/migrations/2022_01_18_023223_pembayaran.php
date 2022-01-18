<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->char('jenis_jasa', 1);
            $table->char('jenis_pembayaran', 1)->nullable();
            $table->text('img_bukti')->nullable();
            $table->tinyInteger('img_invoice');
            $table->char('status', 1)->default('0');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pembayaran');
    }
}
