<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class PermissionFormComponent extends Component
{
	public $permission, $edit_permission;

	public $selectedRoles;

	protected $listeners = ['refreshComponent' => '$refresh'];
	protected $rules = [
		'permission.name' => 'required',
		'permission.slug' => 'required',
		'permission.model' => 'required',
		'permission.description' => ''
	];

	public function createPermission(){
		$this->validate();

		$permission = Permission::create([
			'name' => $this->permission['name'],
			'slug' => $this->permission['slug'],
			'description' => $this->permission['description'] ?? null,
			'model' => $this->permission['model'],
		]);

		$this->attachPermissionToRoles($permission);

		session()->flash('success', 'Successfully Created Permission.');

		return redirect()->route('admin.permission.edit', ['permission' => $permission]);
	}

	public function updatePermission() {
		$this->validate();
		$this->permission->save();
		$this->attachPermissionToRoles($this->permission);
		session()->flash('success', 'Successfully Updated Permission.');
	}

	protected function attachPermissionToRoles(Permission $permission){
		$roles = Role::findMany($this->selectedRoles);

		$roles->each(function($role, $key) use($permission) {
			$role->attachPermission($permission);
		});
	}

	public function mount(){
		$this->permission = $this->edit_permission ?? null;

		isset($this->edit_permission) ? ($this->selectedRoles = $this->edit_permission->roles->isNotEmpty() ? $this->edit_permission->roles->pluck('id') : []) : null;
	}

	public function render(){ return view('livewire.admin.permission-form-component', ['roles' => Role::all()]); }
}
