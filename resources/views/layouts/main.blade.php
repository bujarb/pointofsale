<!DOCTYPE html>
<html lang="en">
@include('partials.header')
  <body>
    @include('partials.nav')
    <div class="container-fluid mycontainer">
      @include('flash::message')
      @include('flashy::message')
      @yield('content')
    </div>
    @include('partials.js')
    @yield('script')
  </body>
</html>
