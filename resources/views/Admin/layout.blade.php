@include('Admin.head')
  <body>
    <div class="container-scroller">

        @include('Admin.slider')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        @include('Admin.navbar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')
          </div>
          <!-- content-wrapper ends -->
@include('Admin.footer')