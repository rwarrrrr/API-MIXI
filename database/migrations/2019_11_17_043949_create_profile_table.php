<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image',255);
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('phone',255);
            $table->string('tempat_lahir',255);
            $table->date('tanggal_lahir');
            $table->string('alamat',255);
            $table->string('kota',255);
            $table->string('pekerjaan',255);
            $table->string('type_mobil',255);
            $table->string('warna_mobil',255);
            $table->integer('tahun_mobil');
            $table->string('panggilan',255);
            $table->string('nama_keren',255);
            $table->string('club_sekarang',255);
            $table->string('ukurang_seragam',255);
            $table->string('facebook',255);
            $table->string('twitter',255);
            $table->string('instagram',255);
            $table->string('hobby',255);
            $table->integer('point')->nullable();
            $table->integer('card_id');
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
        Schema::dropIfExists('profile');
    }
}
