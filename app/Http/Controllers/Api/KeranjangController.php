<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{

  public function index(){

    $data = Keranjang::paginate(10);

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
        'jumlah_barang' => 'required',
        'barang_id' => 'required',
        'penjual_id' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $user = Auth::user();
    $id = $user['id'];

    $data = new Keranjang;
    $data->jumlah_barang = $request->input('jumlah_barang');
    $data->barang_id = $request->input('barang_id');
    $data->penjual_id = $request->input('penjual_id');
    $data->users_id = $id;

    if ($data->save()) {
      $res['message'] = "Success Menambahkan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menambahkan Data";
      return response($res);
    }

  }

  public function edit($id_keranjang,Request $request){

    $validator = Validator::make($request->all(), [
        'jumlah_barang' => 'required',
        'barang_id' => 'required',
        'penjual_id' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $user = Auth::user();
    $id = $user['id'];

    $data = Keranjang::find($id_keranjang);
    $data->jumlah_barang = $request->input('jumlah_barang');
    $data->barang_id = $request->input('barang_id');
    $data->penjual_id = $request->input('penjual_id');
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

    $data = Keranjang::find($id);

    if ($data->delete()) {
      $res['message'] = "Success Menghapus Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menghapus Data";
      return response($res);
    }

  }

  public function search($key){

    $data = Keranjang::where('id', $key)->get();

    if ($data) {
      $res['message'] = 'Berhasil Ambil Data';
      $res['value'] = $data;
      return response($res);
    }else {
      return response('Data Di Database Kosong');
    }

  }

}
