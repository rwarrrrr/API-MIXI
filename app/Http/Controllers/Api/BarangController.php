<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{

  public function index(){

    $data = Barang::paginate(10);

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
        'image1' => 'required',
        'judul' => 'required',
        'harga' => 'required',
        'deskripsi' => 'required',
        'stock' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $user = Auth::user();
    $id = $user['id'];

    $data = new Barang;
    $data->image1 = $request->input('image1');
    $data->image2 = $request->input('image2');
    $data->image3 = $request->input('image3');
    $data->judul = $request->input('judul');
    $data->harga = $request->input('harga');
    $data->deskripsi = $request->input('deskripsi');
    $data->stock = $request->input('stock');
    $data->kategori_id = $request->input('kategori_id');
    $data->penjual_id = $id;
    $data->users_id = $id;

    if ($data->save()) {
      $res['message'] = "Success Menambahkan Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menambahkan Data";
      return response($res);
    }

  }

  public function edit($id_barang,Request $request){

    $validator = Validator::make($request->all(), [
        'image1' => 'required',
        'judul' => 'required',
        'harga' => 'required',
        'deskripsi' => 'required',
        'stock' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }

    $user = Auth::user();
    $id = $user['id'];

    $data = Barang::find($id_barang);
    $data->image1 = $request->input('image1');
    $data->image2 = $request->input('image2');
    $data->image3 = $request->input('image3');
    $data->judul = $request->input('judul');
    $data->harga = $request->input('harga');
    $data->deskripsi = $request->input('deskripsi');
    $data->stock = $request->input('stock');
    $data->kategori_id = $request->input('kategori_id');
    $data->penjual_id = $id;
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

    $data = Barang::find($id);

    if ($data->delete()) {
      $res['message'] = "Success Menghapus Data";
      return response($res);
    }else {
      $res['message'] = "Gagal Menghapus Data";
      return response($res);
    }

  }

  public function search($key){

    $data = Barang::where('id', $key)
    ->orWhere('deskripsi', 'like', '%' . $key . '%')
    ->orWhere('judul', 'like', '%' . $key . '%')
    ->orWhere('harga', 'like', '%' . $key . '%')
    ->get();

    if ($data) {
      $res['message'] = 'Berhasil Ambil Data';
      $res['value'] = $data;
      return response($res);
    }else {
      return response('Data Di Database Kosong');
    }

  }

}
