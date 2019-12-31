<?php

namespace App\Http\Controllers\UserControllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Model\UserModel;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends BaseController
{
	public function userLogin (Request $request) {
		$rules = [
			'email' => 'required|email',
			'password' => 'required'
		];
		$message = [
			'email.email' => 'email must be in format',
			'email.required' => 'email is required',
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
				'success' => 0,
				'data' => $errorMessges
			];
			return response()->json($response);
		} else {
			$user_email = $request->input('email');
			$password = $request->input('password');
			$user = UserModel::where("email", $user_email)
							->select("firstname","lastname","email", "password")
							->first();

			if (empty($user) === false) {
				if (Hash::check($password, $user->password)) {
					$response = [
						'code' => 200,
						'success' => 1,
						'message' => "success",
						"data" => $user
					];
					return response()->json($response);
				}
				
			}
			$response = [
				'code' => 200,
				'success' => 0,
				'message' => "Invalid Email or Password"
			];
			return response()->json($response);
		}
	}

	public function userRegister(Request $request)
	{
		try {
			$rules = [
				'email' => 'required|email',
				'first_name' => 'required',
				'last_name' => 'required',
				'password' => 'required|required_with:confirm_password|same:confirm_password',
				'confirm_password' => 'required'
			];
			$message = [
				'email.email' => 'email must be in format',
				'email.required' => 'email is required',
				'first_name.required' => 'First name is required',
				'last_name.required' => 'Last name is required',
				'password.required' => 'password is required',
				'password.same' => 'Password and confirm password should match',
				'confirm_password.required' => 'Confirm Password is required'
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
				$params = $request->all();
				$user = UserModel::where("email", $params["email"])
								->first();

				if (empty($user) === false) {
					$response = [
						'code' => 200,
						'success' => 0,
						'data' => null,
						'message' => "Email Already Exists"
					];
					return response()->json($response);
				} else {
					$user = new UserModel;
					$user->email = $params["email"];
					$user->firstname = $params["first_name"];
					$user->lastname = $params["last_name"];
					$user->password = Hash::make($params["password"]);
					
					$user->save();
					$response = [
						'code' => 200,
						'success' => 1,
						'data' => $user,
						'message' => "Success"
					];
					return response()->json($response);
				}
			}
		} catch (Exception $e) {
			$response = [
				'code' => 200,
				'success' => 1,
				'data' => $e,
				'message' => "Success"
			];
			return response()->json($response);
		}
	}
}
