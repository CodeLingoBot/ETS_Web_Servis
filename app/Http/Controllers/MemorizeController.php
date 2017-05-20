<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator, Response, DB, Hash, Mail;
use App\word;
use Auth;
use App\users;
use App\memorize;

class MemorizeController extends Controller
{

	public function ReadMemorize(Request $request){
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

			$user=users::where('api_token',$request->get('api_token'))->first();
			$memorizes=$user->memorize;

			foreach ($memorizes as $memorize) {
					$words[]=word::where('id',$memorize->words_id)->first();
			}

				return Response::json([
				    "status" => "OK",
				    "code" => "0",
					  "results" => $words,
				]);

	}

	public function SaveMemorize(Request $request)
	{

		$validator = Validator::make($request->all(),[
				'api_token' => 'required|exists:users,api_token',
				'words_id' => 'required|exists:words,id'
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

				 $memorize_control = DB::table('memorizes')->where('words_id', $request->get('words_id'));

				 if(!$memorize_control->count()>0){

					    $user=users::where('api_token',$request->get('api_token'))->first();
					 		$memorize=new memorize();
					 		$memorize->users_id=$user->id;
					 		$memorize->words_id=$request->get('words_id');
					 		$memorize->save();

				 }

				 return Response::json([
								    "status" => "OK",
									"results" => 0 ]);
	 }

}
