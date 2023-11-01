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
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

    <!-- partial:navbar -->
    @include('admin.partials.navbar')

    <!-- users main panel -content-->
    <div class="main-panel">
      <div class="content-wrapper">

        @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

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

              <!-- Form Start -->
              <form class="admin-edit-product" method="POST" action="{{ route('admin.addProducts') }}"
                id="admin-add-product" enctype="multipart/form-data">
                @csrf
                <div class="container" style="margin-bottom: 10px;">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name" class="product-input-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="name" placeholder="Product Name">
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="category" class="product-input-label">Category</label>
                        <select class="js-example-basic-single form-control max-width: 100%" id="product_category" name="category">
                          @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                        @error('category')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="price" class="product-input-label">Price</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-primary text-white">Php</span>
                                </div>
                                <input type="text" class="form-control" id="product_price" name="price" placeholder="No comma (,) needed)">
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                              @error('price')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                              <label for="qty" class="product-input-label">Stock Quantity</label>
                              <div class="input-group">
                                <input type="number" class="form-control" id="qty" name="qty" min="0" value="1">
                              </div>
                              @error('qty')
                                <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="item_description" class="product-input-label">Product Description</label>
                        <textarea class="form-control" id="product_description" name="item_description" rows="10"></textarea>
                        @error('item_description')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_available" value="1" checked>
                        <label class="form-check-label" for="is_available">Available</label>
                      </div>
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_featured" value="1">
                        <label class="form-check-label" for="is_featured">Featured Product</label>
                      </div>
                    </div>
                    <div class="col-md-6">

                      <div class="form-group">
                          <label for="image" class="product-input-label">Product Image <span style="color: red;"><em>(500x500 pixels and PNG format required)</em></span></label>
                          <input id="product-img-upload" type="file" class="form-control file-upload-info" name="image" 
                              onchange="if(this.files.length > 0) { document.getElementById('image-preview').style.display = 'block'; } else { document.getElementById('image-preview').style.display = 'none'; }">
                          @error('image')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                          <div id="image-preview" style="width: 200px; height: 200px; overflow: hidden; border: 1px solid #ccc; display: none;">
                              <img id="product-img-tag" src="" alt="Upload Image" style="width: 100%; height: 100%; object-fit: cover;">
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="tags" class="product-input-label">Tags/Labels</label>
                        <select class="js-example-basic-multiple form-control max-width: 100%" multiple="multiple" id="product_tags" name="tags[]">
                          @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                          @endforeach
                        </select>
                        @error('tags')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                        <div class="form-group col-md-2">
                        <div class="d-flex justify-content-start">
                          <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                          <button class="btn btn-dark">Cancel</button>
                        </div>
                      </div>
                </div>
                



              </form>
              <!-- Form End -->

              <div class="add-product-message col-md-3" id="form-submit-msg"></div>
            </div>
          </div>
        </div>
      </div>
      @include('admin.partials.footer')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


  <!-- plugins:js -->
  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-products.js') . '?v=' . filemtime(public_path('admin/assets/js/admin-products.js')) }}"></script>
  {{-- <script src="{{ asset('admin/assets/js/file-upload.js') }}"></script> --}}
</body>

</html>
