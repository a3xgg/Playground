<?php

namespace App\Interfaces\auth;
use Illuminate\Http\Request;

interface AuthLogoutInterface {
  public function logout(Request $request);
}