<div class="container">
	<div class="mt-2"><a href="{{ route('admin.role-permission') }}" class="btn btn-secondary">Back</a></div>
	<h2> Attach User Role or Permission </h2>
	<label for="name">Name</label>
	<p class="form-control">{!! $user->name !!}</p>
	<label for="email">Email</label>
	<p class="form-control">{!! $user->email !!}</p>

	<form wire:submit.prevent="attachRolePermission">
		<div wire:ignore>
			<select wire:model="selectedPermissions" class="multi-select form-control" multiple>
				@foreach($permissions as $permission)
					<option value="{{ $permission->id }}"> {{ $permission->name }} </option>
				@endforeach
			</select>
		</div>

		<select wire:model="selectedRole" class="form-control mt-2">
			<option value="" disabled selected> Select a Role </option>
			@foreach($roles as $role)
				<option value="{{ $role->id }}"> {{ $role->name }} </option>
			@endforeach
		</select>

		@if(session()->has('success'))
			<div class="alert alert-success mt-2"> {{ session('success') }} </div>
		@endif

		<button type="submit" class="btn btn-primary form-control mt-2">{{ $selectedRole == null ? 'Attach' : 'Update' }}</button>
	</form>
</div>

@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			$('.multi-select').select2({
				placeholder: 'Select Permissions',
			});
			$('.multi-select').on('change', function() {
				@this.selectedPermissions = $(this).val();
			});
			window.Livewire.hook('component.initialized', () => {
				$('.multi-select').val(@this.selectedPermissions).trigger('changed');
			});
		});
		
	</script>
@endpush
