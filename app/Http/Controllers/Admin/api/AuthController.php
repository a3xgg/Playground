<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Services\Admin\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	protected $authService;

	public function __construct(AuthServices $authService){
		$this->authService = $authService;
	}

	public function login(Request $request) { return $this->authService->login($request); }

	public function logout(Request $request) { return $this->authService->logout($request); }
}
