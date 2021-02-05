<?php

namespace App\Services\Browser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\Shared\AuthSharedServices;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\auth\AuthRegisterInterface;

class AuthServices extends AuthSharedServices implements AuthRegisterInterface{
  public function login(Request $request){
    dd($request->wantsJson());
    $validate = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required'
    ]);
    if($validate->fails()) {
      return response(['message' => 'Email and Password is required.', 'from' => 'Browser Service'], 400);
    }

    return Auth::attempt($request->only(['email', 'password'])) ? $this->generateToken($request) : response(['message' => 'Incorrect Email or Password.'], 401);
  }

  public function register(Request $request){
    $validate = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required'
    ]);
    if($validate->fails()) {
      return response(['message' => 'Fields should not be empty.'], 400);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    return response(['message' => 'ok', 'data' => $user]);
  }

  public function logout(){
    $this->revokeToken();
    return response(['message' => 'Token Revoked.']);
  }
}