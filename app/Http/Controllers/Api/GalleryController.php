<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Gallery;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{

    public function index(){

      $data = Gallery::all();

      if($data){
        $res['message'] = 'Berhasil Mengambil Data';
        $res['value'] = $data;
        return response($res,200);
      }else {
        return response('Data Kosong Dalam Database');
      }

    }

    public function tambah(Request $request){

      $user = Auth::user();
      $id = $user['id'];

      $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required',
        'kegiatan_id' => 'required',
        'image' => 'required'
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $data = new Gallery;
      $data->title = $request->input('title');
      $data->description = $request->input('description');
      $data->image = $request->input('image');
      $data->users_id = $id;
      $data->kegiatan_id = $request->input('kegiatan_id');

      if ($data->save()) {
        return response('Berhasil Menambahkan Data',200);
      }else {
        return response('Gagal Menambahkan Data',400);
      }

    }

    public function edit($id_edit,Request $request){

      $user = Auth::user();
      $id = $user['id'];

      $validator = Validator::make($request->all(), [
          'title' => 'required',
          'description' => 'required',
          'kegiatan_id' => 'required',
          'image' => 'required'
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $data = Gallery::find($id_edit);
      $data->title = $request->input('title');
      $data->description = $request->input('description');
      $data->image = $request->input('image');
      $data->users_id = $id;
      $data->kegiatan_id = $request->input('kegiatan_id');

      if ($data->save()) {
        return response('Berhasil Mengubah Data',200);
      }else {
        return response('Gagal Mengubah Data',400);
      }

    }

    public function delete($id){

      $data = Gallery::find($id);

      if ($data->delete()) {
        return response('Berhasil Menghapus Data',200);
      }else {
        return response('Terjadi Kesalahan Saat Menghapus Data',400);
      }

    }

    public function search($key){

      $data = Gallery::where('id', $key)
      ->orWhere('title', 'like', '%' . $key . '%')
      ->orWhere('description', 'like', '%' . $key . '%')
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
