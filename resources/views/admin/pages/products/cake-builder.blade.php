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


        <!-- page breadcrumb-->
        <div class="page-header">
          <ol class="breadcrumb">
            <li class="breadcrumb-item custom-breadcrumb">Products</li>
            <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Cake Builder Details</li>
          </ol>
        </div>

        <div class="col-lg-3 grid-margin stretch-card mx-auto">
          <div class="card">
           
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              <h4 class="card-title">Edit Cake Builder</h4>

              <!-- Form  Start -->
              <form class="edit-cakeBuilder" method="POST" action="{{route('updateCakeBuilder')}}"
                id="admin-edit-product" enctype="multipart/form-data">
                @csrf

                @foreach ($cakeBuilder as $detail)

                <div class="row">
                    <!-- Product Name -->
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="size">Cake Size</label>
                        <input type="text" class="form-control" id="size" name="size[]" value="{{$detail->size}}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">Php</span>
                            </div>
                            <input type="number" class="form-control" id="price" name="price[]" value="{{$detail->price}}">
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Product Description -->
                    <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description[]" rows="8" value="{{$detail->description}}">{{$detail->description}}</textarea>
                    </div>
                    </div>
                </div>

                @endforeach

                <div class="row">
                    <div class="col-md-12">
                <div class="form-group">
                    <label for="item_description"><strong>Cake Builder Ordering Status</strong></label><br>
                    <input type="checkbox" name="is_available" value="1" {{ $cakeBuilderStatus ? 'checked' : '' }}
                        style="vertical-align: middle; height: 15px; width: 15px">
                    <label for="is_available" style="font-size: 1rem; vertical-align: middle;">Available</label>
                </div>
                </div>
                </div>

                
                <!-- Product Submit-->
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
      @include('admin.partials.footer')
      <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
  </div>

  <!-- plugins:js -->
  @include('admin.partials.script')


 

</body>

</html>