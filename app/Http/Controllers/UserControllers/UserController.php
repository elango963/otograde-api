<?php

namespace App\Http\Controllers\UserControllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Model\UserModel;


class UserController extends BaseController
{
	public function userLogin (Request $request) {
		$user_email = $request->input('user_email');
		$password = $request->input('password');
	    $rules = [
	    	'user_email' => 'required|email',
	    	'password' => 'required'
	   	];
	   	$message = [
	   		'user_email.email' => 'email must be in format',
	    	'user_email.required' => 'email is required',
	    	'password.required' => 'password is required',
	    ];
	    $validator = \Validator::make($request->all(), $rules, $message);
	    if ($validator->fails()) {
	    	$messages = $validator->messages();
	    	$errorMessges = [];
	    	foreach ($messages->toArray() as $key => $message) {
               $errorMessges["errors"][] = ["key" => $key, "message" => $message[0]];
            }
	    	$response = [
	            'code' => 400,
	            'status' => "failed",
	            'data' => $errorMessges
	        ];
            return response()->json($response);
	    } else {
	    	$user = UserModel::where("email", $user_email)
	    					->where("password", $password)
	    					->select("firstname","lastname","email")
	    					->first();

	    	if (empty($user) === false) {
	    		$response = [
		            'code' => 200,
		            'status' => "failed",
		            'data' => $user
		        ];
	            return response()->json($response);
	    	} else {
	    		$response = [
		            'code' => 200,
		            'status' => "failed",
		            'message' => "User Not Found"
		        ];
	            return response()->json($response);
	    	}
	    }
	}
  
}
