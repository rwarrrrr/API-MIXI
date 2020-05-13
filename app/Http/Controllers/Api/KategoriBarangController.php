<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\KategoriBarang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KategoriBarangController extends Controller
{

  public function index(){

    $data = KategoriBarang::paginate(10);

    if ($data) {
      $res['message'] = 'Berhasil Ambil Data';
      $res['value'] = $data;
      return response($res);
    }else {
      return response('Data Di Database Kosong');
    }

  }

  public function tambah(Request $request){

    $validator = Validator::make($request->all(), [
        'image' => 'required',
        'judul' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $data = new KategoriBarang;
    $data->image = $request->input('image');
    $data->judul = $request->input('judul');

    if ($data->save()) {
      $res['message'] = "Success Menambahkan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menambahkan Data";
      return response($res);
    }

  }

  public function edit($id_artikel,Request $request){

    $validator = Validator::make($request->all(), [
        'image' => 'required',
        'judul' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $data = KategoriBarang::find($id_artikel);
    $data->image = $request->input('image');
    $data->judul = $request->input('judul');

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function delete($id){

    $data = KategoriBarang::find($id);

    if ($data->delete()) {
      $res['message'] = "Success Menghapus Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menghapus Data";
      return response($res);
    }

  }

  public function search($key){

    $data = KategoriBarang::where('id', $key)
    ->orWhere('judul', 'like', '%' . $key . '%')
    ->paginate(10);

    if ($data) {
      $res['message'] = 'Berhasil Ambil Data';
      $res['value'] = $data;
      return response($res);
    }else {
      return response('Data Di Database Kosong');
    }

  }

}
