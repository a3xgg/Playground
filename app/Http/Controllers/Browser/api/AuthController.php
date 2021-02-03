<?php

namespace App\Http\Controllers\Browser\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Browser\AuthServices;

class AuthController extends Controller
{

	protected $authService;

	public function __construct(AuthServices $authService){ $this->authService = $authService; }

	public function login(Request $request){ return $this->authService->login($request); }

	public function register(Request $request){ return $this->authService->register($request); }

	public function logout(){ return $this->authService->logout(); }
}
