<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPembelianShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pembelian_shop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_transaksi');
            $table->string('status',255);
            $table->integer('total_bayar');
            $table->string('alamat',255);
            $table->integer('barang_id');
            $table->integer('penjual_id');
            $table->integer('profile_id');
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
        Schema::dropIfExists('transaksi_pembelian_shop');
    }
}
