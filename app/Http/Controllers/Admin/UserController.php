<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  public function create(){
		return view('admin.user.user-form');
	}

	public function edit(User $user){
		return view('admin.user.user-form', ['user' => $user]);
	}
}
