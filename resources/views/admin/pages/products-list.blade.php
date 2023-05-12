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
          <h3 class="page-title">Products</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Products List</li>
              <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
          </nav>
        </div>

        {{-- <tr>
          <th>Product Name</th>
          <th>Price</th>
          <th>Category</th>
          <th>Description</th>
          <th>Rating</th>
          <th>Availability</th>
        </tr>

        @foreach ($products as $product)
        <tr>
          <td>{{ $product->name }}</td>
          <td>{{ $product->price }}</td>
          <td>{{ $product->category }}</td>
          <td style="max-width: 400px;" class="text-truncate">{{ $product->item_description }}</td>
          <td>{{ $product->rating }}</td>
          <td>TBD</td>
        </tr>
        @endforeach --}}

        <div class="col-lg-11 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Products List</h4>
                <a href="#" class="btn btn-primary btn-fw">+ Add Product</a>
              </div>
              <div class="col-lg-2">
                <form class="mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Product Name <i class="mdi mdi-arrow-down"></i></th>
                      <th>Price <i class="mdi mdi-arrow-down"></i></th>
                      <th>Category <i class="mdi mdi-arrow-down"></i></th>
                      <th>Rating <i class="mdi mdi-arrow-down"></i></th>
                      <th>Availability <i class="mdi mdi-arrow-down"></i></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->price }}</td>
                      <td>{{ $product->category }}</td>
                      <td>{{ $product->rating }}</td>
                      <td>TBD</td>
                      <td><button class="btn btn-md btn-inverse-success">Edit</button></td>
                      <td><button class="btn btn-md btn-inverse-danger">Delete</button></td>
                      </td>
                    </tr>
                    @endforeach
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

  <!-- plugins:js -->
  @include('admin.partials.script')
</body>

</html>