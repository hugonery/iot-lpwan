<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    
    public function login(Request $request)
    {
      try
      {
        $user = \App\Users::where('email', '=', $request->email)->first();

        if ($user->status==0) {
          return response()->json([ 'error' => \Lang::get('auth.failed') ], 400);
        }
        
        $this->validateLogin($request);
        $credentials = $this->credentials($request);
        $token = \JWTAuth::attempt($credentials);
        return $this->responseToken($token);

      }
      catch(\Exception $e)
      {
        return response()->json([ 'error' => \Lang::get('auth.failed') ], 400);
      }
      
    }
    
    private function responseToken($token)
    {
      return $token ? [
        'token' => $token, 
        'name' => auth()->user()->name, 
        'email' => auth()->user()->email
        ] :
        response()->json([ 'error' => \Lang::get('auth.failed') ], 400);
    }
    
    public function logout(){
      \Auth::guard('api')->logout();
      return response()->json([],204); //No-content
    }
    
    public function refresh(){
      $token = \Auth::guard('api')->refresh();
      return ['token' => $token]; //No-content
    }
}