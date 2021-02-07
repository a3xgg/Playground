<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionController extends Controller
{
  public function create(){
		return view('admin.role-permission.permission-form');
	}

	public function edit(Permission $permission){
		return view('admin.role-permission.permission-form', ['permission' => $permission]);
	}
}
