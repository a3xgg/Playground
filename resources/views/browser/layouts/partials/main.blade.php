<!DOCTYPE html>
<html lang="en">
<head>
  @include('browser.layouts.partials.meta')
</head>
<body>
  @routes
  @yield('master')
  @include('browser.layouts.partials.scripts')
</body>
</html>