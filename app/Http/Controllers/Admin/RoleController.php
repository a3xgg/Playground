<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

class RoleController extends Controller
{
  public function create(){
		return view('admin.role-permission.role-form');
	}

	public function edit(Role $role){
		return view('admin.role-permission.role-form', ['role' => $role]);
	}
}
