<div>
	<div class="d-flex justify-content-center align-items-center"><h2>Roles</h2></div>
	<div class="container mt-4">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th>Role Name</th>
					<th>Level</th>
					<th>Slug</th>
					<th>Description</th>
					<th>Permissions</th>
					<th># of Users</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($roles as $role)
					<tr>
						<td> {{ $role->name }} </td>
						<td> {{ $role->level }} </td>
						<td> {{ $role->slug }} </td>
						<td> {{ $role->description ?? 'No Description Given.' }} </td>
						<td>
							@if(count($role->permissions) > 0)
								@foreach($role->permissions as $permission)
									<span class="badge badge-pill badge-primary">{{ $permission->name }}</span>
								@endforeach
							@elseif(count($role->permissions) == 0 && $role->slug == 'super.admin')
								<span class="badge badge-pill badge-primary">All Permissions</span>
							@endif
						</td>
						<td> <span class="badge badge-pill badge-primary">{{ count($role->users) > 1 ? count($role->users)." users" : count($role->users)." user" }}</span> </td>
						<td>
							<a href="{{ route('admin.role.edit', ['role' => $role]) }}" class="btn btn-sm btn-warning"> Edit </a>
							<button onclick="deleteRole({{ $role }})" class="btn btn-sm btn-danger"> Delete </button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-end"><a href="{{ route('admin.role.create') }}" class="btn btn-secondary">Create New Role</a></div>
	</div>
	<div class="d-flex justify-content-center align-items-center"><h2>Permissions</h2></div>
	<div class="container mt-4">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th>Permission Name</th>
					<th>Slug</th>
					<th>Description</th>
					<th>Model</th>
					<th>Attached Role</th>
					<th>Attached Users</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($permissions as $permission)
					<tr>
						<td>{{ $permission->name }}</td>
						<td>{{ $permission->slug }}</td>
						<td>{{ $permission->description ?? 'No Description Given.'}}</td>
						<td>{{ $permission->model }}</td>
						<td>
							@foreach ($permission->roles  as $role)
								<span class="badge badge-pill badge-primary">{{ $role->name }}</span>
							@endforeach
						</td>
						<td>
							<span class="badge badge-pill badge-primary">{{ count($permission->users) > 1 ? count($permission->users).' users' : count($permission->users).' user' }}</span>
						</td>
						<td>
							<a href="{{ route('admin.permission.edit', ['permission' => $permission]) }}" class="btn btn-sm btn-warning"> Edit </a>
							<button wire:click="deletePermission({{ $permission }})" class="btn btn-sm btn-danger"> Delete </button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-end"><a href="{{ route('admin.permission.create') }}" class="btn btn-secondary">Create New Permission</a></div>
	</div>
	<div class="d-flex justify-content-center align-items-center"><h2>Users</h2></div>
	<div class="container mt-4">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Role(s)</th>
					<th>Specific Permission(s)</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						@if(count($user->roles) == 0)
							<a href="{{ route('admin.user.edit', ['user' => $user]) }}" class="btn badge badge-pill badge-success">+ Attach Role</a>
						@endif
						@foreach ($user->roles as $role)
							<span class="badge badge-pill badge-primary">{{ $role->name }}</span>
							<button onclick="revokeAccess({{ $user }}, {{ $role }})" class="btn badge badge-pill badge-danger">-</button>
						@endforeach
					</td>
					<td>
						@if($user->userPermissions->isEmpty())
							<a href="{{ route('admin.user.edit', ['user' => $user]) }}" class="btn badge badge-pill badge-success">+ Attach Specific Permissions</a>
						@endif
						@foreach ($user->userPermissions as $userPermission)
							<span class="badge badge-pill badge-primary">{{ $userPermission->name }}</span>	
						@endforeach
					</td>
					<td>
						<a href="{{ route('admin.user.edit', ['user' => $user]) }}" class="btn btn-warning btn-sm">Edit</a>
						<button onclick="revokeAll({{ $user }})" class="btn btn-danger btn-sm">Revoke All</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{-- <div class="d-flex justify-content-end"><a href="{{ route('admin.user.create') }}" class="btn btn-secondary">Create New User</a></div> --}}
	</div>
</div>

@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<script>
		function deleteRole(role){
			Swal.fire({
				title: 'Are you sure?',
				text: 'This action cannot be reverted.',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Delete',
				confirmButtonColor: 'red',
				reverseButtons:true
			}).then((res) => {
				if(res.isConfirmed){
					window.livewire.emit('deleteRole', role);
				}
			});
		}

		function revokeAccess(user, role){
			Swal.fire({
				title: 'Are you sure?',
				text: `Revoking ${role.name} access for ${user.name}`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Delete',
				confirmButtonColor: 'red',
				reverseButtons:true
			}).then((res) => {
				if(res.isConfirmed){
					window.livewire.emit('revokeAccess', user, role);
				}
			});
		}

		function revokeAll(user){
			Swal.fire({
				title: 'Are you sure?',
				text: `Revoking all access for ${user.name}. This action cannot be reverted.`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Delete',
				confirmButtonColor: 'red',
				reverseButtons:true
			}).then((res) => {
				if(res.isConfirmed){
					window.livewire.emit('revokeAllAccess', user);
				}
			});
		}
		document.addEventListener('DOMContentLoaded', function(){
			
		});
	</script>
@endpush
