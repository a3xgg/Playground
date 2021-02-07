@extends('admin.layouts.master')

@section('content')
  @livewire('admin.user-form-component', ['user' => $user ?? null])
@endsection