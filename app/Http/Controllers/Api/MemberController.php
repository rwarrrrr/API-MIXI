<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use Validator;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{

  public function index(){

    $data = Member::all();

    if($data){
      $res['message'] = 'Berhasil Mengambil Data';
      $res['value'] = $data;
      return response($res,200);
    }else {
      return response('Data Kosong Dalam Database');
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

    $data = new Member;
    $data->title = $request->input('title');
    $data->description = $request->input('description');
    $data->image = $request->input('image');

    if ($data->save()) {
      return response('Berhasil Menambahkan Data',200);
    }else {
      return response('Gagal Menambahkan Data',400);
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

    $data = Member::find($id_edit);
    $data->title = $request->input('title');
    $data->description = $request->input('description');
    $data->image = $request->input('image');

    if ($data->save()) {
      return response('Berhasil Mengubah Data',200);
    }else {
      return response('Gagal Mengubah Data',400);
    }

  }

  public function delete($id){

    $data = Member::find($id);

    if ($data->delete()) {
      return response('Berhasil Menghapus Data',200);
    }else {
      return response('Terjadi Kesalahan Saat Menghapus Data',400);
    }

  }

  public function search($key){

    $data = Member::where('id', $key)
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
