<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{

  public $successStatus = 200;

    public function login()
    {
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('Breakpoin Appliction')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] =  $user->createToken('Breakpoin Appliction')->accessToken;
        $success['name'] =  $user->name;
        $success['id'] = $user->id;

        $data = new Profile;
        $data->first_name = $input['name'];
        $data->users_id = $user->id;
        $data->image = 'http://localhost:8000/api/file/download/7uDtSO7Giz.png';
        $data->no_anggota = str::random(10);
        $data->point = '0';

        if ($data->save()) {
          return response()->json(['success' => $success], $this->successStatus);
        }else {
          return response()->json(['message' => 'Terjadi Kesalahan']);
        }

    }


    public function details()
    {
        $user = Auth::user();
        $data = Profile::find($user['id']);

        $res['profile'] = $user;
        $res['detail'] = $data;
        return response($res);
    }

    public function update(Request $request){

      $user = Auth::user();
      $id = $user['id'];

      $data = Profile::find($id);
      $data->image = $request->input('image');
      $data->first_name = $request->input('first_name');
      $data->last_name = $request->input('last_name');
      $data->phone = $request->input('phone');
      $data->tempat_lahir = $request->input('tempat_lahir');
      $data->tanggal_lahir = $request->input('tanggal_lahir');
      $data->alamat = $request->input('alamat');
      $data->kota = $request->input('kota');
      $data->pekerjaan = $request->input('pekerjaan');
      $data->type_mobil = $request->input('type_mobil');
      $data->warna_mobil = $request->input('warna_mobil');
      $data->tahun_mobil = $request->input('tahun_mobil');
      $data->panggilan = $request->input('panggilan');
      $data->nama_keren = $request->input('nama_keren');
      $data->club_sekarang = $request->input('club_sekarang');
      $data->ukuran_seragam = $request->input('ukuran_seragam');
      $data->facebook = $request->input('facebook');
      $data->twitter = $request->input('twitter');
      $data->instagram = $request->input('instagram');
      $data->hobby = $request->input('hobby');
      $data->point = $request->input('point');
      $data->card_id = $id;


       if ($data->save()) {
         $res['message'] = "Success Mengubah Data";
         return response($res);
       }else {
         $res['message'] = "Gagal Mengubah Data";
         return response($res);
       }

    }

}
