<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampling', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_id');
            $table->char('model', 2);
            $table->text('img');
            $table->text('desc');
            $table->tinyInteger('jml');
            $table->timestamps();
            $table->foreign('slot_id')->references('id')->on('slot_s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sampling');
    }
}
