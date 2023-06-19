<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.partials.head')
  <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
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
            <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Edit a product</li>
          </ol>
        </div>

        <div class="col-lg-11 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Edit {{ $product->name }}</h4>

              <!-- Form  Start -->
              <form class="admin-edit-product" method="POST" action="{{ route('admin.editProducts', $product->id) }}"
                id="admin-edit-product" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <!-- Product Name -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Product Name</label>
                      <input type="text" class="form-control" id="product_name" name="name" placeholder="Product Name"
                        value="{{ $product->name }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Product Category -->
                    <div class="form-group">
                      <label for="category">Category</label>
                      <input type="text" class="form-control" id="product_category" name="category"
                        placeholder="Category" value="{{ $product->category }}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <!-- Product Price -->
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input type="text" class="form-control" id="product_price" name="price" placeholder="Price"
                        value="{{ $product->price }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Product Image-->
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append uploadprod-img-btn">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <!-- Product Image End -->
                  </div>
                </div>

                <!-- Product Description -->
                <div class="form-group">
                  <label for="item_description">Description</label>
                  <textarea class="form-control" id="product_description" name="item_description"
                    rows="5">{{ $product->item_description }}</textarea>
                </div>
                <!-- Product Submit -->
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-dark">Cancel</button>
              </form>
              <!-- Form End -->
              <div class="add-product-message col-md-3" id="form-submit-msg">
              </div>
            </div>
          </div>
        </div>

        @if (session('message'))
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
        @endif
      </div>
      <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
  </div>

  <!-- plugins:js -->
  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-products.js') }}"></script>
  <script src="{{ asset('admin/assets/js/file-upload.js') }}"></script>
</body>

</html>