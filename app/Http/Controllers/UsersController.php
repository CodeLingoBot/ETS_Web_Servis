<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Response, DB, Hash;

class UsersController extends Controller{

      public function RegisterService(Request $request){
      $rules = [
        'username' => 'required|email|unique:users,username',
        'companyname' => 'required',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'activationcode' => 'required|numeric',
      ];
      $validator = Validator::make($request->all(), $rules);
      if($validator->fails())
      {
        $errors = array();
        print_r($validator->errors()->messages());
        foreach ($validator->errors()->messages() as $key => $value) {
          $errors[] = [
            'field' => $key,
            'message' => $value[0]
          ];
        }

        return Response::json([
          'result' => 'Error',
          "code" => "10",
          'errors' => $errors,
        ]);
      }

      $activationcode = DB::table('activation_codes')->select('id', 'activationcode',
      'user_email')->where('user_email', $request->get('email'))->first()->activationcode;

      if($activationcode==$request->get('activationcode')){

          DB::table('users')->insert([
            'email'    => $request->get('email'),
            'username' => $request->get('username'),
            'companyname' => $request->get('companyname'),
            'password' => Hash::make($request->get('password')),
            'activationcode' => $activationcode,
          ]);

          return Response::json([
            'result' => 'Susccess',
            "code" => "0",
          ]);

      }else {

        return Response::json([
          'result' => 'Error',
          "code" => "1",
          "hata:"=>"aktivasyon kodu hatalı",
        ]);

      }

    }
    
    public function LoginService(Request $request){

    $rules = [
      'email' => 'required',
      'password' => 'required|min:6',
    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails()){
      $errors = array();
      foreach ($validator->errors()->messages() as $key => $value) {
        $errors[] = [
          'field' => $key,
          'message' => $value[0]
        ];
      }

      return Response::json([
        'result' => 'Error',
        "code" => "10",
        'errors' => $errors,
      ]);

    }

    $user_control = DB::table('users')->select('id', 'email','username',
    'companyname','password as token','password','activationcode')->where('email', $request->get('email'));

    if($user_control->count()>0 && Hash::check($request->get('password'), $user_control->first()->password)){

      return Response::json([
        'result' => 'Succes',
        "code" => "0",
        'user' => $user_control->first(),
      ]);

    }else{

      return Response::json([
        'result' => 'Giriş Yapılamadı,Bilgilerinizi Kontrol Edip Tekrar Deneyiniz.',
        "code" => "15"
      ]);

    }

  }

}
