<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

  protected $table = 'profile';
  protected $primary_key = 'id';

  protected $fillable = [
      'id', 'image', 'first_name','last_name','phone','tempat_lahir','alamat','kota','pekerjaan','type_mobil','warna_mobil','tahun_mobil','panggilan','nama_keren','club_sekarang','ukuran_seragam','facebook','twitter','instagram','point','card_id','users_id',
  ];


}
