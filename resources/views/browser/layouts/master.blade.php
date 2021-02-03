@extends('browser.layouts.partials.main')

@section('meta')
  <title>{{ config('app.name') }}</title>
@endsection

@section('master')
  <div id="vue_browser">
    @yield('content')
  </div>
@endsection