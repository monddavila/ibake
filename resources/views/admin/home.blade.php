<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.partials.head')
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

</head>

<body>
  <div class="container-scroller">

    @include('admin.partials.sidebar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:navbar -->
      @include('admin.partials.navbar')
      <!-- partial:dashboard -->
      @include('admin.pages.dashboard.dashboard')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- plugins:js -->
  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/dashboard-orders.js') }}?v={{ filemtime(public_path('admin/assets/js/dashboard-orders.js')) }}"></script>
</body>

</html>