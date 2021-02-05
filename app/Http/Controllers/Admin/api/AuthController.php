<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Services\Admin\api\AuthApiServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	protected $authApiServices;

	public function __construct(AuthApiServices $authApiServices){
		$this->authApiServices = $authApiServices;
	}

	public function login(Request $request) { return $this->authApiServices->login($request); }

	public function logout() { return $this->authApiServices->logout(); }
}
