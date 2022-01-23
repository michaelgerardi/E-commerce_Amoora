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
            $table->unsignedBigInteger('slot_id')->nullable();
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('bayar_id')->nullable();
            $table->char('model', 2);
            $table->text('img');
            $table->char('ling_b', 5)->nullable();
            $table->char('ling_pgang', 5)->nullable();
            $table->char('ling_pingl', 5)->nullable();
            $table->char('ling_lh', 5)->nullable();
            $table->char('leb_bahu', 5)->nullable();
            $table->char('pj_lengan', 5)->nullable();
            $table->char('ling_kr_leng', 5)->nullable();
            $table->char('ling_lengan', 5)->nullable();
            $table->char('ling_pergel', 5)->nullable();
            $table->char('leb_muka', 5)->nullable();
            $table->char('leb_pungg', 5)->nullable();
            $table->char('panj_pungg', 5)->nullable();
            $table->char('panj_baju', 5)->nullable();
            $table->char('tinggi_pingl', 5)->nullable();
            $table->char('ling_pinggang', 5)->nullable();
            $table->char('ling_pesak', 5)->nullable();
            $table->char('ling_paha', 5)->nullable();
            $table->char('ling_lutut', 5)->nullable();
            $table->char('ling_kaki', 5)->nullable();
            $table->char('panj_cln_rok', 5)->nullable();
            $table->char('tingg_dudk', 5)->nullable();
            $table->text('desc');
            $table->tinyInteger('jml')->nullable();
            $table->char('status', 1);
            $table->timestamps();
            $table->foreign('slot_id')->references('id')->on('slot_s');
            $table->foreign('cus_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('bayar_id')->references('id')->on('pembayaran');
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
        Schema::dropIfExists('sampling');
    }
}
