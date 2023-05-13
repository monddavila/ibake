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
              <form class="admin-add-product">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productName">Product Name</label>
                      <input type="text" class="form-control" id="productName" placeholder="Product Name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productCategory">Category</label>
                      <input type="email" class="form-control" id="productCategory" placeholder="Category">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productPrice">Price</label>
                      <input type="text" class="form-control" id="productPrice" placeholder="Price">
                    </div>
                  </div>
                  <div class="col-md-6">
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
                  </div>
                </div>

                <div class="form-group">
                  <label for="productDescription">Textarea</label>
                  <textarea class="form-control" id="productDescription" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-dark">Cancel</button>
              </form>
              <!-- Form End -->
              <div class="add-product-message col-md-3">
                <div class="alert alert-success" role="alert">
                  This is a success alert—check it out!
                </div>
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