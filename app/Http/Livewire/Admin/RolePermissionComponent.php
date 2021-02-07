<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;
use Livewire\Component;

class RolePermissionComponent extends Component
{

	public $roles, $permissions, $users;

	protected $listeners = ['refreshComponent' => '$refresh', 'deleteRole', 'revokeAccess', 'revokeAllAccess'];

	protected $rules = [];
	
	public function deleteUser(User $user){
		$user->delete();
		return $this->emitSelf('refreshComponent');
	}

	public function revokeAccess(User $user, Role $role){
		$user->detachRole($role);
	}

	public function revokeAllAccess(User $user){
		$user->detachAllPermissions();
		$user->detachAllRoles();

		return session()->flash('success', 'Successfully revoked all roles and permissions.');
	}

	// Deleting Permissions and Roles using delete() will undergo a soft delete instead of deleting the row.
	// No choice but to use the forceDelete() function.
	public function deletePermission(Permission $permission) {
		$permission->roles()->detach();
		$permission->users()->detach();
		$permission->forceDelete();
		return $this->emit('refreshComponent');
	}

	public function deleteRole(Role $role){
		$role->permissions()->detach();
		$role->users()->detach();
		$role->forceDelete();
		return $this->emitSelf('refreshComponent');
	}

	public function mount(){
		$this->roles = Role::all();
		$this->permissions = Permission::all();
		$this->users = User::all();
	}

	public function render()
	{
		return view('livewire.admin.role-permission-component');
	}
}
