<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.partials.meta')
</head>
<body>
  @routes
  @yield('master')
  @include('admin.layouts.partials.scripts')
</body>
</html>