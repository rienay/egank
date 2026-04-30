<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.header')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('admin.layouts.navbar')
  @include('admin.layouts.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('admin.layouts.footer')

</div>

</body>
</html>