@extends('admin.layouts.master')

@section('content')
  @livewire('admin.permission-form-component', ['edit_permission' => $permission ?? null])
@endsection