<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator, Response, DB, Hash, Mail;
use App\word;
use Auth;
use App\users;
use App\memorize;

class WordsPackController extends Controller
{

    public function WordsPack(Request $request){

        $validator = Validator::make($request->all(),[
            'api_token' => 'required|exists:users,api_token'
            ]);

        if($validator->fails())
        {
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

        $bas=0;
        $wordspack=DB::table("kelimeler")->select("iskeletid")->groupBy('iskeletid')->get();
        foreach ($wordspack as  $value) {

          $count[] = DB::table('kelimeler')->where('iskeletid',$value->iskeletid)->count();
          $pack[] = DB::table('kelimeler')->where('iskeletid',$value->iskeletid)->get();

        }

        $boyut=count($count);
        for ($x=0; $x < $boyut ; $x++) {

            $kactane = count($pack[$x]);
            $gelecek=($kactane/3)+1;
            for($bas=0;$bas<$kactane;$bas=$bas+20){

                $group[] = DB::table('kelimeler')->where('iskeletid',$pack[$x][0]->iskeletid)->offset($bas)->limit(20)->get();

            }

        }

        return Response::json([
              "status" => "OK",
              "code" => "0",
              "results" => $group,
        ]);

    }

}
