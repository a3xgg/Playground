@extends('admin.layouts.master')

@section('content')
  <h1>Admin Dashboard - <a href="{{ route('admin.logout') }}">Logout</a></h1>
  <a href="{{ route('laravelroles::roles.index') }}">Roles and Permissions</a>
@endsection