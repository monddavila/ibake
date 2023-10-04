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
                        <select class="js-example-basic-single" style="width:100%" id="category" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                    <label for="price" class="product-input-label">Price <span style="color: red;">(No comma ' , ' separator needed)</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white">Php</span>
                        </div>
                        <input type="text" class="form-control" id="product_price" name="price" placeholder="Price" value="{{ old('price', $product->price) }}">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>

                  <div class="col-md-6">
                    <!-- Product Tags -->
                    <div class="form-group">
                        <label for="tags" class="product-input-label">Tags/Labels</label>
                        <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" id="product_tags" name="tags[]">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                      <!-- Product Image Upload -->
                      <div class="form-group">
                          <label>Upload Image</label>
                          <input type="file" name="image" class="form-control" id="product-img-upload">
                          
                      </div>
                      <!-- Product Image Upload End -->
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                      <!-- Uploaded Product Image -->
                      <div class="form-group">
                          <label>Selected Image</label>
                          <div class="input-group">
                              <img id="uploaded-img-preview" src="{{ asset($product->image) }}" alt="Product Image 1" class="img-thumbnail" style="max-width: 200px;">
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <!-- Product Image -->
                      <div class="form-group">    
                          <label>Original Product Image</label>
                          <div class="input-group">
                              <img src="{{ asset($product->image) }}" alt="Product Image 2" class="img-thumbnail" style="max-width: 200px;">
                          </div>
                      </div>
                  </div>            
              </div>
              <div class="row">
                <div class="col-md-6">
                <!-- Product Description -->
                <div class="form-group">
                  <label for="item_description">Product Description</label>
                  <textarea class="form-control" id="product_description" name="item_description" rows="8">{{ $product->item_description }}</textarea>
                </div>
                </div>

                <div class="col-md-6">
                <!-- Product Status -->
                <div class="form-group">
                    <label for="item_description">Product Status</label><br>
                    <input type="checkbox" name="is_available" value="1" {{ $product->availability ? 'checked' : '' }}
                        style="vertical-align: middle; height: 20px; width: 20px">
                    <label for="is_available" style="font-size: 1.2rem; vertical-align: middle;">Available</label>
                    <input type="checkbox" name="is_featured" value="1" {{ $product->isfeatured ? 'checked' : '' }}
                        style="vertical-align: middle; height: 20px; width: 20px; margin-left: 20px;">
                    <label for="is_featured" style="font-size: 1.2rem; vertical-align: middle;">Featured Product</label>
                </div>
                </div>
              </div>

                
                
                <!-- Product Submit -->
                <button type="submit" class="btn btn-primary mr-2">Update</button>
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

  <script>
    // JavaScript to update the uploaded image preview
    $(document).ready(function() {
        $("#product-img-upload").change(function() {
            readURL(this, "uploaded-img-preview");
        });

        function readURL(input, targetElementId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#" + targetElementId).attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
  </script>

</body>

</html>