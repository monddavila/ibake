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
            <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Add a product</li>
          </ol>
        </div>

        <div class="col-lg-11 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add a new product to the menu</h4>

              <!-- Form  Start -->
              <form class="admin-add-product" id="admin-add-product">
                @csrf
                <div class="row">
                  <!-- Product Name -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="product_name">Product Name</label>
                      <input type="text" class="form-control" id="product_name" name="product_name"
                        placeholder="Product Name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Product Category -->
                    <div class="form-group">
                      <label for="product_category">Category</label>
                      <input type="text" class="form-control" id="product_category" name="product_category"
                        placeholder="Category">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <!-- Product Price -->
                    <div class="form-group">
                      <label for="product_price">Price</label>
                      <input type="text" class="form-control" id="product_price" name="product_price"
                        placeholder="Price">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Product Image-->
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="img[]" class="file-upload-default">
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
                  <label for="product_description">Textarea</label>
                  <textarea class="form-control" id="product_description" name="product_description"
                    rows="5"></textarea>
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
      </div>
      <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
  </div>

  <!-- plugins:js -->
  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-products.js') }}"></script>
</body>

</html>