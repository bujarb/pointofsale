<!DOCTYPE html>
<html lang="en">
@include('partials.header')
  <body>
    <div class="container">
      @yield('content')
    </div>
    @include('partials.js')
  </body>
</html>
