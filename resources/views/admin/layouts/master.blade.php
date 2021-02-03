@extends('admin.layouts.partials.main')

@section('meta-content')
  <title>{{ config('app.name') }}</title>
@endsection

@section('master')
  @yield('content')
@endsection