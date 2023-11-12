<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.partials.head')
</head>
<body>
  <div class="container-scroller">
    <!-- partial:sidebar -->
    @include('admin.partials.sidebar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

    <!-- partial:navbar -->
    @include('admin.partials.navbar')

    <!-- users main panel -content-->
    <div class="main-panel">
      <div class="content-wrapper">

        <!-- page breadcrumb-->
        <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item custom-breadcrumb">Reports</li>
                    <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Customer Records</li>
                </ol>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Customer Records</h4>
              <div class="d-flex justify-content-between align-items-center">
                <p class="card-description"> All records List </p>
                <a href="" class="btn btn-success me-2">
                      <i class="fas fa-download"></i> Export
                  </a>

              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="user-search-input" placeholder="Search by Customer Name or Order ID"
                    aria-label="Search" aria-describedby="search-button">
                  <button class="btn btn-outline-secondary" type="button" id="reset-search-btn">Reset</button>
                </div>
              </div>
              <div class="table-responsive" style="max-height: 650px; overflow-y: auto;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Customer Name</th>
                      <th>Type</th>
                      <th class="sortable" id="sort-order_id" data-sort="order_id">Order ID</th>
                      <th class="sortable" id="sort-total_price" data-sort="total_price">Total Price</th>
                      <th class="sortable" id="sort-shipping_method" data-sort="shipping_method">Shipping Method</th>
                      <th class="sortable" id="sort-created_at" data-sort="created_at">Date of Order</th>
                      <th class="sortable" id="sort-delivery_date" data-sort="delivery_date">Delivery Date</th>
                      <th class="sortable" id="sort-updated_at" data-sort="updated_at">Date Completed</th>
                    </tr>
                  </thead>
                  <tbody id='users-table-body'>
                    @include('admin.pages.reports.customer-records-table')
                  </tbody>
                </table>
                  <!-- Pagination Links -->
                  {{--<div class="d-flex justify-content-left mt-4">
                      {{ $allOrders->onEachSide(1)->links() }}
                  </div>--}}

              </div>
            </div>
          </div>
        </div>

      </div>
      @include('admin.partials.footer')
      <!-- content-wrapper ends -->
    </div>
    <!-- main-panel ends -->
  </div>

  <!-- plugins:js -->
  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-transactions.js') }}?v={{ filemtime(public_path('admin/assets/js/admin-transactions.js')) }}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
