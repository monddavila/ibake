<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.partials.head')
  <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/monolith.min.css"/>
</style>
<style>
.color-border-container {
  display: inline-flex;
  border: 1px solid #000; 
  padding: 0px;
}

#color-picker {
  width: 100%;
  height: 100%;
}

</style>




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

                <div class="color-border-container">
  <div id="color-picker" value="#ffffff"></div>
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

  <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

  <script>
      var pickr = new Pickr({

        el: '#color-picker',
        theme: 'monolith',

        defaultRepresentation: 'HEX',

        swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
    ],

        components: {
          preview: true,
          opacity: true,
          hue: true,

          interaction: {
            hex: true,
            rgba: false,
            hsla: false,
            hsva: false,
            cmyk: false,
            input: true,
            clear: false,
            save: true
          }
        },



        onChange(hex) {
      // Update the background color of the "color-display" element
      const colorDisplay = document.querySelector('.color-display');
      colorDisplay.style.backgroundColor = hex.toHEXA().toString();
    }

      });
    </script>


</body>

</html>
