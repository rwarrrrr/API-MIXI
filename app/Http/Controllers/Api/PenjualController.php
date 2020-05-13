<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Penjual;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualController extends Controller
{

  public function index(){

    $data = Penjual::paginate(10);

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
        'nama_toko' => 'required',
        'alamat' => 'required',
        'image' => 'required',
        'kota' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $user = Auth::user();
    $id = $user['id'];

    $data = new Penjual;
    $data->image = $request->input('image');
    $data->nama_toko = $request->input('nama_toko');
    $data->alamat = $request->input('alamat');
    $data->kota = $request->input('kota');
    $data->users_id = $id;

    if ($data->save()) {
      $res['message'] = "Success Menambahkan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menambahkan Data";
      return response($res);
    }

  }

  public function edit($id_penjual,Request $request){

    $validator = Validator::make($request->all(), [
        'nama_toko' => 'required',
        'image' => 'required',
        'alamat' => 'required',
        'kota' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $user = Auth::user();
    $id = $user['id'];

    $data = Penjual::find($id_penjual);
    $data->image = $request->input('image');
    $data->nama_toko = $request->input('nama_toko');
    $data->alamat = $request->input('alamat');
    $data->kota = $request->input('kota');
    $data->users_id = $id;

    if ($data->save()) {
      $res['message'] = "Success Mengubah Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Mengubah Data";
      return response($res);
    }

  }

  public function delete($id){

    $data = Penjual::find($id);

    if ($data->delete()) {
      $res['message'] = "Success Menghapus Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menghapus Data";
      return response($res);
    }

  }

  public function search($key){

    $data = Penjual::where('id', $key)
    ->orWhere('nama_toko', 'like', '%' . $key . '%')
    ->orWhere('kota', 'like', '%' . $key . '%')
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
