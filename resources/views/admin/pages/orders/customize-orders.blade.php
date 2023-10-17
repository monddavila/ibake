<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.partials.head')
</head>

<body>
  <div class="container-scroller">

    @include('admin.partials.sidebar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:navbar -->
      @include('admin.partials.navbar')
      <!-- partial:dashboard -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Customized Cake Order Requests</h4>

                  <!-- partial:search box -->
                    <div class="col-lg-3">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" id="orderId-search-input" placeholder="Search Order ID"
                          aria-label="Search" aria-describedby="search-button">
                        <button class="btn btn-outline-secondary" type="button" id="reset-search-btn">Reset</button>
                      </div>
                    </div>

                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th class="sortable" id="sort-orderStatus" data-sort="orderStatus"> Action <i class="sort-icon mdi mdi-sort"></i></th>
                          <th class="sortable" id="sort-orderID" data-sort="orderID"> Order No. <i class="sort-icon mdi mdi-sort"></i></th>
                          <th class="sortable" id="sort-created_at" data-sort="created_at">Request Date <i class="sort-icon mdi mdi-sort"></i></th>
                          <th class="sortable" id="sort-date_needed" data-sort="date_needed"> Date Needed <i class="sort-icon mdi mdi-sort"></i></th>
                          <th class="sortable" id="sort-name" data-sort="users.firstname"> Requestor </th>
                          <th> Phone No. </th>
                          <th> Uploaded Sample </th>
                          <th> Message </th>
                          <th class="sortable" id="sort-cakePrice" data-sort="cakePrice"> Price <i class="sort-icon mdi mdi-sort"></i></th>
                        </tr>
                      </thead>
                      <tbody id='custom-orders-body'>
                      @include('admin.pages.orders.customize-orders-table')
                      </tbody>
                    </table>
                      <div class="pagination">
                          {{ $orders->links() }}
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('admin.partials.footer')
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- plugins:js -->
  <script>
    document.querySelectorAll(".cancel-button").forEach(function(button) {
    button.addEventListener("click", function (event) {
        if (!confirm("Are you sure you want to reject this order? The order will be declined and the customer will be notified.")) {
            event.preventDefault(); 
        }
    });
    });
  </script>

<script>
    document.querySelectorAll(".approve-button").forEach(function(button) {
    button.addEventListener("click", function (event) {
        if (!confirm("Are you sure you want to approve this order? Order will be transferred to active order queue list and the customer will be notified.")) {
            event.preventDefault(); 
        }
    });
    });
  </script>

  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-custom-orders.js') }}?v={{ filemtime(public_path('admin/assets/js/admin-users.js')) }}"></script>

</body>

</html>