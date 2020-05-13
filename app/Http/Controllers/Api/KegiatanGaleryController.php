<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KegiatanGalery;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KegiatanGaleryController extends Controller
{

  public function index(){

    $data = KegiatanGalery::all();

    if ($data) {
      $res['message'] = 'Berhasil Mengambil Data';
      $res['value'] =  $data;
      return response($res,200);
    }else {
      return response('Terjadi Kesalahan Saat mengambil data' , 400);
    }

  }

  public function tambah(Request $request){

    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $user = Auth::user();
    $id = $user['id'];

    $data = new KegiatanGalery;
    $data->title = $request->input('title');
    $data->description = $request->input('description');
    $data->users_id = $id;

    if ($data->save()) {
      $res['message'] = 'Berhasil Menambahkan Data';
      return response($res,200);
    }else {
      return response('Terjadi Kesalahan Saat Menambahkan Data',400);
    }

  }

  public function edit($id_edit,Request $request){

    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $user = Auth::user();
    $id = $user['id'];

    $data = KegiatanGalery::find($id_edit);
    $data->title = $request->input('title');
    $data->description = $request->input('description');
    $data->users_id = $id;

    if ($data->save()) {
      $res['message'] = 'Berhasil Mengubah Data';
      return response($res,200);
    }else {
      return response('Terjadi Kesalahan Saat Mengubah Data',400);
    }

  }

  public function delete($id){

    $data = KegiatanGalery::find($id);

    if ($data->delete()) {
      $res['message'] = 'Berhasil Menghapus Data';
      return response($res,200);
    }else {
      return response('Terjadi Kesalahan Saat Menghapus Data',400);
    }

  }

  public function search($key){

    $data = KegiatanGalery::where('id', $key)
    ->orWhere('title', 'like', '%' . $key . '%')
    ->orWhere('description', 'like', '%' . $key . '%')
    ->get();

    if (count($data)>0) {
      $res['message'] = 'Berhasil Ambil Data';
      $res['value'] = $data;
      return response($res);
    }else {
      return response('Terjadi Kesalahan Saat Mengambil Data / Data Di Database Kosong');
    }

  }

}
