<?php

namespace App\Services\Admin;

use App\Services\Shared\AuthSharedServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthServices extends AuthSharedServices {

  public function login(Request $request){
    
  }

  public function logout(Request $request){
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return ;
  }
}