<!DOCTYPE html>
<html lang="en">

<head>
  @include('customer.partials.head')
</head>

<body>
  <div class="container-scroller">

    @include('customer.partials.sidebar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:navbar -->
      @include('customer.partials.navbar')
      <!-- partial:dashboard -->
      @include('customer.pages.dashboard')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- plugins:js -->
  @include('customer.partials.script')
  <script src="{{ asset('admin/assets/js/dashboard-orders.js') }}"></script>
</body>

</html>