<div class="container">
	<a href="{{ route('admin.role-permission') }}" class="btn btn-secondary mt-2">Back</a>
	<h2>{{ $edit_role == null ? 'Create New Role' : 'Update Role' }}</h2>
	<form wire:submit.prevent="{{ $edit_role == null ? 'createRole' : 'updateRole' }}">
		@csrf
		<label>Role Name</label>
		<input type="text" wire:model="role.name" class="form-control mt-2 mb-2" placeholder="Role Name">
			@error('role.name') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror

		<label>Slug</label>
		<input type="text" wire:model="role.slug" class="form-control mt-2 mb-2" placeholder="Slug">
			@error('role.slug') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror

		<label>Level</label>
		<input type="number" wire:model="role.level" class="form-control mt-2" placeholder="Level">
			@error('role.level') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
		<textarea class="form-control mt-2 mb-2" wire:model="role.description" cols="30" rows="10" placeholder="Description..."></textarea>
		<div wire:ignore>
			<select wire:model="selectedPermissions" class="multi-select form-control" multiple="multiple">
				@foreach ($permissions as $key=>$permission)
					<option value="{{ $permission->id }}">{{ $permission->name }}</option> 
				@endforeach
			</select>
		</div>

		@if(session()->has('success'))
			<div class="alert alert-success mt-2">{{ session('success') }}</div>
		@endif

		<button type="submit" class="btn btn-primary form-control mt-2">{{ $edit_role == null ? 'Create' : 'Update' }}</button>
	</form>
</div>

@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function(){
			$('.multi-select').select2({
				placeholder: 'Select Permissions',
			});
			$('.multi-select').on('change', function() {
				@this.selectedPermissions = $(this).val();
			});
			window.Livewire.hook('component.initialized', () => {
				$('.multi-select').val(@this.selectedPermissions).trigger('change');
			});
		});
	</script>
@endpush
