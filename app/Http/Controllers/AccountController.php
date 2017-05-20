<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator, Response, DB, Hash, Mail;
use App\word;
use Auth;
use App\users;
class AccountController extends Controller
{
  public function ReadWords(Request $request){

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
          
        $result=word::all();

        return Response::json([
            "status" => "OK",
            "code" => "0",
          "results" => $result,
        ]);
}


  	public function loginRegister(Request $request){

      	  $validator = Validator::make($request->all(),[
      	      'deviceID' => 'required'
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

  	     $user_control = DB::table('users')->where('deviceID', $request->get('deviceID'));

    	  if($user_control->count()>0){

    	    return Response::json([
    	            "status" => "OK",
    	            "code" => "0",
    							"Operation"=>"login",
    	            "results" => users::where('deviceID',$request->get('deviceID'))->first(),]);

    	  }else{

    	    $user=new users();
    	    $user->api_token=str_random(60);
    	    $user->deviceID=$request->get('deviceID');
    	    $user->save();

    	    return Response::json([
    	              "status" => "OK",
    	              "code" => "0",
    								"Operation"=>"register",
    	              "results" => users::where('deviceID',$request->get('deviceID'))->first()]);

    	  }

  	}

}
