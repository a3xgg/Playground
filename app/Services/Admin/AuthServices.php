<?php

namespace App\Services\Admin;

use App\Services\Shared\AuthSharedServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthServices extends AuthSharedServices {

  protected const PATH = 'admin.auth.';

  public function login(Request $request){
    return $request->method() == 'GET' ? view(self::PATH . 'index') : $this->authenticate($request);
  }

  public function authenticate(Request $request){
    $request->validate([
      'email' => 'required',
      'password' => 'required'
    ]);

    return Auth::attempt([
      'email' => $request->email, 
      'password' => $request->password]) 
        ? redirect()->route('admin.index') : redirect()->route('admin.login');
  }

  public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
  }
}