<?php

namespace App\Http\Controllers;
use Log;
use Validator;
use Illuminate\Http\Response as IlluminateResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	
    protected $statusCode = IlluminateResponse::HTTP_OK;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respond($data, $headers = [])
    {
        return response()->json($this->responseStatus($data), $this->getStatusCode(), $headers);
    }

    public function responseStatus($data)
    {
        return array_merge($data, ['statusCode' => $this->getStatusCode()]);
    }

    public function getGuzzleClient()
    {
        return app()->make(Client::class);
    }

    public function createJWTToken($user, $jwt)
    {
        $token = $jwt->createToken($user);

        return $token->token();
    }

    public function validator($request, $rules, $messages = [])
    {
        $validator = Validator::make($request->all(), $rules, $messages);
		Log::info("validator Request :: ".json_encode($request->all()));
        if ($validator->fails()) {
            $messages = $validator->messages();
            Log::info("validator error message :: ".json_encode($messages));

            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $messages,
                'statusCode' => 422,
                'isLoggedIn' => false,
            ], 422);
        }

        return false;
    }
}
