<?php

namespace App\Services\Admin\api;

use App\Services\Shared\AuthSharedServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthServices extends AuthSharedServices {

  public function login(Request $request){
    $validate = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required'
    ]);
    if($validate->fails()) {
      return response(['message' => 'Field\'s should not be empty.', 'from' => 'Admin Service'], 400);
    }
    return Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => true]) ? $this->generateToken($request) : response(['message' => 'Unauthorized'], 401) ;
  }

  public function logout(Request $request){
    $this->revokeToken();
    return response(['message' => 'Token Revoked.']);
  }

}