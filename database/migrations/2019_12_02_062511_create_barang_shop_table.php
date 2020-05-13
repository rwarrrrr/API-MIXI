<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_shop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image1',255);
            $table->string('image2',255);
            $table->string('image3',255);
            $table->string('judul',255);
            $table->integer('harga');
            $table->string('deskripsi',255);
            $table->integer('stock');
            $table->integer('kategori_id');
            $table->integer('penjual_id');
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
        Schema::dropIfExists('barang_shop');
    }
}
