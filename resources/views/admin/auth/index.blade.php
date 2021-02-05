@extends('admin.layouts.master')

@section('content')
  <div>
    <p>Login Page</p>
    <form action="{{ route('admin.login') }}" method="POST">
      @csrf
      <input type="text" name="email" id="email" placeholder="Email">
      <input type="password" name="password" id="password" placeholder="Password">
      @if($errors->any())
        <span style="color:red;">{{ $errors->first() }}</span>
      @endif
      <button type="submit">Login</button>
    </form>
  </div>
@endsection