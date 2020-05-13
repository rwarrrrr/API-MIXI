<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjual_shop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image',255);
            $table->string('nama_toko',255);
            $table->string('alamat',255);
            $table->string('kota',255);
            $table->integer('users_id');        
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
        Schema::dropIfExists('penjual_shop');
    }
}
