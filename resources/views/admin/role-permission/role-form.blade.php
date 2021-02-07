@extends('admin.layouts.master')

@section('content')
  @livewire('admin.role-form-component', ['edit_role' => $role ?? null])
@endsection