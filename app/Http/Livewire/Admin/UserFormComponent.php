<?php

namespace App\Http\Livewire\Admin;

use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;
use Livewire\Component;

class UserFormComponent extends Component
{

	public $user;

	public $selectedRole = '';
	public $selectedPermissions;

	public function attachRolePermission(){
		$this->selectedRole == '' ? null : $this->user->syncRoles((int) $this->selectedRole);
		$this->user->syncPermissions($this->selectedPermissions);
		session()->flash('success', 'Successfully Attached.');
	}

	public function mount(){
		$this->selectedRole = $this->user->roles->isNotEmpty() ? $this->user->roles->first()->id : '';
		$this->selectedPermissions = $this->user->getPermissions()->isEmpty() ? [] : $this->user->getPermissions()->pluck('id');
	}

	public function render()
	{
		return view('livewire.admin.user-form-component', ['roles' => Role::all(), 'permissions' => Permission::all()]);
	}
}
