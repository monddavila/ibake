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
            <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Add a product</li>
          </ol>
        </div>

        <div class="col-lg-11 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add a new product to the menu</h4>



              <!-- Form  Start -->
              <form class="admin-edit-product" method="POST" action="{{ route('admin.addProducts') }}"
                id="admin-add-product" enctype="multipart/form-data">
                @csrf
                <div class="container" style="margin-bottom: 10px;">
                  <div class=" row">
                    <div class="col-md-6">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td class="add-product-td">
                              <label for="name" class="product-input-label">Product Name</label>
                              <input type="text" class="form-control" id="product_name" name="name"
                                placeholder="Product Name">
                            </td>
                          </tr>
                          <tr>
                            <td class="add-product-td">
                              <label for="category" class="product-input-label">Category</label>
                              <select class="form-control" id="product_category" name="category">
                                <option value="Occasion Cakes">Occasion Cakes</option>
                                <option value="Wedding Cakes">Wedding Cakes</option>
                                <option value="Customized Cakes">Customized Cakes</option>
                                <option value="Small Cakes">Small Cakes</option>
                                <option value="Tub Cakes">Tub Cakes</option>
                                <option value="Cake Pops">Cake Pops</option>
                                <option value="Cupcakes">Cupcakes</option>
                                <option value="Cookies">Cookies</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td class="add-product-td">
                              <label for="price" class="product-input-label">Price</label>
                              <input type="text" class="form-control" id="product_price" name="price"
                                placeholder="Price">
                            </td>
                          </tr>
                          <tr>
                            <td class="add-product-td">
                              <label for="item_description" class="product-input-label">Textarea</label>
                              <textarea class="form-control" id="product_description" name="item_description"
                                rows="10"></textarea>
                            </td>
                          </tr>
                          <tr>
                            <td class="add-product-td">
                              <input type="checkbox" name="is_available" value="1" checked
                                style="vertical-align: middle; height: 20px; width: 20px">
                              <label for="is_available"
                                style="font-size: 1.2rem; vertical-align: middle;">Available</label>
                              <input type="checkbox" name="is_featured" value="1" checked
                                style="vertical-align: middle; height: 20px; width: 20px; margin-left: 20px;">
                              <label for="is_featured" style="font-size: 1.2rem; vertical-align: middle;">Featured
                                Product</label>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td class="add-product-td">
                              <div class="form-group">
                                <label for="image" class="product-input-label">Category Image</label>
                                <input id="product-img-upload" type="file" class="form-control file-upload-info"
                                  name="image">
                                <img src="#" id="product-img-tag" height="250px" width="auto" />
                                <!--for preview purpose -->
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-2">
                  <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                  <button class="btn btn-dark">Cancel</button>
                </div>
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
  {{-- <script src="{{ asset('admin/assets/js/file-upload.js') }}"></script> --}}
</body>

</html>