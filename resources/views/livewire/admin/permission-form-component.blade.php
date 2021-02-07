<div class="container">
	<div class="mt-2 mb-2"><a href="{{ route('admin.role-permission') }}" class="btn btn-secondary">Back</a></div>
	<h2>{{ $edit_permission == null ? 'Create New Permission' : 'Update Permission'}}</h2>

	<form wire:submit.prevent="{{ $edit_permission == null ? 'createPermission' : 'updatePermission' }}">
		@csrf
		<input type="text" placeholder="Permission Name" wire:model="permission.name" class="form-control mt-2">
		<input type="text" placeholder="Slug" wire:model="permission.slug" class="form-control mt-2">
		<input type="text" placeholder="Model" wire:model="permission.model" class="form-control mt-2">
		<textarea type="text" placeholder="Description" wire:model="permission.description" class="form-control mt-2 mb-2" cols="30" rows="10"> </textarea>

		<div wire:ignore>
			<select wire:model="selectedRoles" class="multi-select form-control" multiple>
				@foreach ($roles as $role)
					<option value="{{ $role->id }}">{{ $role->name }}</option>
				@endforeach
			</select>
		</div>

		@if(session()->has('success'))
			<div class="alert alert-success mt-2">{{ session('success') }}</div>
		@endif

		<button type="submit" class="btn btn-primary form-control mt-2">{{ $edit_permission == null ? 'Create' : 'Update' }}</button>
	</form>
</div>

@push('scripts')
	<script>
		$(document).on('DOMContentLoaded', () => {
			$('.multi-select').select2({
				placeholder: 'Select Roles',
			});
			$('.multi-select').on('change', function() {
				@this.selectedRoles = $(this).val();
			});
			window.Livewire.hook('component.initialized', () => {
				$('.multi-select').val(@this.selectedRoles).trigger('change');
			});
		});
	</script>
@endpush
