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
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                            </td>
                          </tr>
                          <tr>
                            <td class="add-product-td">
                                <label for="category" class="product-input-label" >Category</label><br><br>  
                                <select class="js-example-basic-single" style="width:100%" id="product_category" name="category">
                                  @foreach($categories as $category)
                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                                        @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                            </td>
                          </tr>

                          <tr>
                            <td class="add-product-td">
                            <label for="price" class="product-input-label">Price</label>
                              <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">Php</span>
                              </div>
                              <input type="text" class="form-control" id="product_price" name="price"
                                placeholder="Product Price (No comma ' , ' separator needed)">
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                              </div>
                                        @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                            </td>
                          </tr>
                    
                          <tr>
                            <td class="add-product-td">
                              <label for="item_description" class="product-input-label">Product Description</label>
                              <textarea class="form-control" id="product_description" name="item_description"
                                rows="10"></textarea>
                                        @error('item_description')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                            </td>
                          </tr>
                          <tr>
                            <td class="add-product-td">
                              <input type="checkbox" name="is_available" value="1" checked
                                style="vertical-align: middle; height: 20px; width: 20px">
                              <label for="is_available"
                                style="font-size: 1.2rem; vertical-align: middle;">Available</label>
                              <input type="checkbox" name="is_featured" value="1" unchecked
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
                              <label for="image" class="product-input-label">Product Image <span style="color: red;">(500x500px and PNG format required)</span></label>
                                <input id="product-img-upload" type="file" class="form-control file-upload-info"
                                  name="image">
                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                  <div style="width: 200px; height: 200px; overflow: hidden; border: 1px solid #ccc;">
                                      <img id="product-img-tag" src="" alt="Upload Image" style="width: 100%; height: 100%; object-fit: cover;">
                                  </div>
                                <!--for preview purpose -->
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td class="add-product-td">
                              <div class="form-group">
                                <label for="tags" class="product-input-label">Tags/Labels</label><br><br>
                                <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" id="product_tags" name="tags[]">
                                  @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                                        @error('tags')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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