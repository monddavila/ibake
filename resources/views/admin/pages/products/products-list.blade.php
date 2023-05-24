<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.partials.head')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:sidebar -->
    @include('admin.partials.sidebar')

    <!-- partial:navbar -->
    @include('admin.partials.navbar')

    <!-- users main panel -content-->
    <div class="main-panel">
      <div class="content-wrapper">



        <!-- page breadcrumb-->
        <div class="page-header">
          <ol class="breadcrumb">
            <li class="breadcrumb-item custom-breadcrumb">Products</li>
            <li class="breadcrumb-item custom-breadcrumb" aria-current="page">View Products</li>
          </ol>
        </div>

        <div class="col-lg-11 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Products List</h4>
                <a href="{{ route('admin.addProducts') }}" class="btn btn-primary btn-fw">+ Add Product</a>
              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="product-search-input" placeholder="Search"
                    aria-label="Search" aria-describedby="search-button">
                  <button class="btn btn-outline-secondary" type="button" id="reset-search-btn">Reset</button>
                </div>
                <div class="mt-2id=" product-list-msg"></div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="sortable col-lg-3" id="sort-name" data-sort="name">Product Name</th>
                      <th class="sortable" id="sort-price" data-sort="price">Price</th>
                      <th class="sortable" id="sort-category" data-sort="category">Category</th>
                      <th class="sortable" id="sort-rate" data-sort="rating">Rating</th>
                      <th class="sortable" id="sort-available" data-sort="availability">Availability</th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id='product-table-body'>
                    @include('admin.pages.products.products-list-table')
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
  </div>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open Modal
  </button>

  <div class="modal fade" id="myModal" tabindex="-1" role="img" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        </div>
        <div class="modal-body">
          ...
        </div>
      </div>
    </div>
  </div>



  <!-- plugins:js -->
  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-products.js') }}"></script>
  <!-- CSS -->

  <!-- JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>