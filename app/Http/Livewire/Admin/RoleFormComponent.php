<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Session;
use jeremykenedy\LaravelRoles\Models\Permission;
use Livewire\Component;
use jeremykenedy\LaravelRoles\Models\Role;

class RoleFormComponent extends Component
{
  public $role;
	public $edit_role;

	public $selectedPermissions, $permissions;

	protected $rules = [
		'role.name' => 'required',
		'role.level' => 'required|integer',
		'role.description' => '',
		'role.slug' => 'required',
		'selectedPermissions' => ''
	];

	protected $listeners = ['refreshComponent' => '$refresh'];

	public function updateRole(){
		$this->validate();
		$this->role->save();
		$this->role->syncPermissions($this->selectedPermissions);
		session()->flash('success', 'Successfully Updated.');
	}

	public function createRole(){
		$this->validate();

		$role = Role::create([
			'name' => $this->role['name'],
			'level' => $this->role['level'],
			'description' => $this->role['description'] ?? null,
			'slug' => $this->role['slug']
		]);

		$role->syncPermissions($this->selectedPermissions);

		session()->flash('success', 'Successfully Created Role.');

		return redirect()->route('admin.role.edit', ['role' => $role]);
	}

	public function mount(){
		$this->permissions = Permission::all();
		$this->role = $this->edit_role ?? null;
		isset($this->edit_role) ? $this->selectedPermissions = ($this->edit_role->permissions->isNotEmpty() ? $this->edit_role->permissions->pluck('id') : []) : null;		
	}

	public function render(){ return view('livewire.admin.role-form-component'); }
}
