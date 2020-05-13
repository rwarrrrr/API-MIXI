<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Artikel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArtikelController extends Controller
{

    public function index(){

      $data = Artikel::all();

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
          'title' => 'required',
          'description' => 'required',
          'image' => 'required'
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $user = Auth::user();
      $id = $user['id'];

      $data = new Artikel;
      $data->title = $request->input('title');
      $data->description = $request->input('description');
      $data->image = $request->input('image');
      $data->users_id = $id;

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
          'title' => 'required',
          'description' => 'required',
          'image' => 'required'
      ]);

      if ($validator->fails()) {
          return response()->json(['error' => $validator->errors()], 401);
      }

      $user = Auth::user();
      $id = $user['id'];

      $data = Artikel::find($id_artikel);
      $data->title = $request->input('title');
      $data->description = $request->input('description');
      $data->image = $request->input('image');
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

      $data = Artikel::find($id);

      if ($data->delete()) {
        $res['message'] = "Success Menghapus Data";
        return response($res);
      }else {
        $res['message'] = "Gagal Menghapus Data";
        return response($res);
      }

    }

    public function search($key){

      $data = Artikel::where('id', $key)
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
