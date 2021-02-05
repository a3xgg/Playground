<?php

namespace App\Interfaces\auth;
use Illuminate\Http\Request;

interface AuthRegisterInterface {
  public function register(Request $request);
}