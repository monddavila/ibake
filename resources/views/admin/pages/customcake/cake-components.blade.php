<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">

    <style>
        .color-box {
        display: inline-block;
        width: 20px; /* Adjust the width as needed */
        height: 20px; /* Adjust the height as needed */
        margin-right: 5px; /* Add spacing between the box and the color value */
        border: 1px solid #000; /* Add a border for better visibility */
        }

    </style>
    <style>
        .color-box-2 {
        display: inline-block;
        width: 20px; /* Adjust the width as needed */
        height: 20px; /* Adjust the height as needed */
        margin-right: 5px; /* Add spacing between the box and the color value */
        border: 1px solid #000; /* Add a border for better visibility */
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
                        <li class="breadcrumb-item custom-breadcrumb">Custom Cake</li>
                        <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Components</li>
                    </ol>
                </div>

                <div class="col-lg-11 grid-margin stretch-card mx-auto">
                    <div class="card">
                        <div class="card-body">
                                @if(session()->has('message-2'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message-2') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif
                            <div class="d-flex justify-content-between align-items-center">

                                <h4 class="card-title">Cake Components</h4>
                            </div>
                            <div class="col-lg-3">
                                <div class="add-product-td">
                                <form id="showReviewsForm" method="GET" action="{{ route('getCakeComponents') }}">
                                    @csrf
                                    <label for="category" class="product-input-label">Select Cake Layer</label>
                                    <select class="js-example-basic-single" style="width: 100%" name="selectedLayer">
                                        <option value="">Choose Cake Layer</option>
                                        @foreach ($uniqueLayers as $component)
                                        <option value="{{$component}}">{{$component}}</option>
                                        @endforeach
                                    </select>
                                    @if(session()->has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session()->get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary btn-fw mt-3">Show</button>
                                    <a href="{{ route('viewCakeComponents') }}" class="btn btn-secondary btn-fw mt-3">Reset</a>
                                </form>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="sortable" id="sort-id" data-sort="id">ID</th>
                                                    <th class="sortable col-lg-3" id="sort-layer" data-sort="layer">Layer</th>
                                                    <th class="sortable" id="sort-name" data-sort="name">Name</th>
                                                    <th class="sortable" id="sort-color" data-sort="color">Color</th>
                                                    <th class="sortable" id="sort-availability" data-sort="availability">Status</th>
                                                    <th class="sortable" id="sort-created" data-sort="created">Created</th>
                                                    <th class="sortable" id="sort-updated" data-sort="updated">Updated</th>

                                                </tr>
                                            </thead>
                                            @foreach ($components as $component)
                                            <tr>
                                                <td>{{ $component->id }}</td>
                                                <td>{{ $component->layer }}</td>
                                                <td>{{ $component->name }}</td>
                                                <td>
                                                    <span class="color-box" style="background-color: {{ $component->color }};"></span>
                                                    {{ $component->color }}
                                                </td>
                                                <td>
                                                    @if($component->availability) Available @else <span style="color: red;">Not Available<span> @endif
                                                </td>
                                                <td>
                                                    {{ date('M-d-y', strtotime($component->created_at)) }}
                                                </td>
                                                <td>
                                                    @if($component->updated_at)
                                                    {{ date('M-d-y', strtotime($component->updated_at)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item edit-component" href="javascript:void(0);"
                                                                data-component-id="{{ $component->id }}" data-component-layer="{{ $component->layer }}"
                                                                data-component-name="{{ $component->name }}" data-component-color="{{ $component->color }}"
                                                                data-component-availability="{{ $component->availability }}" data-default-color="{{ $component->color }}">Edit</a>
                                                            <a class="dropdown-item btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this component?')"
                                                                href="{{ route('deleteComponents', ['id' => $component->id]) }}" style="color: red;">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tbody id='component-table-body'>

                                            </tbody>
                                        </table>
                                        <!-- Pagination Links -->
                                        {{ $components->links() }}
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="container" style="margin-top: 10px;">
                                        <div><h3>Add New Component</h3></div>
                                        @if(session()->has('message-1'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session()->get('message-1') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <form class="admin-add-component" method="POST"
                                            action="{{ route('addComponents') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="container" style="margin-bottom: 10px;">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                        <td>
                                                            <!-- Layer Field (Dropdown List) -->
                                                            <label for="layer" class="product-input-label">Layer</label><br>
                                                            <select id="layer" name="layer" style="width: 100%;" required>
                                                                <option value="flavor">Flavor</option>
                                                                <option value="filling">Filling</option>
                                                                <option value="icing">Icing</option>
                                                                <option value="topborder">Top Border</option>
                                                                <option value="bottomborder">Bottom Border</option>
                                                                <option value="decoration">Decoration</option>
                                                            </select>
                                                            @error('layer')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </td>

                                                            <td>
                                                                <!-- Name Field -->
                                                                <label for="name"
                                                                    class="product-input-label">Name</label><br>
                                                                <input type="text" id="layer" name="name" required
                                                                    style="width:100%">
                                                                @error('name')
                                                                <div
                                                                    class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td>
                                                                <!-- Color Field -->
                                                                <label for="color"
                                                                    class="product-input-label">Hex Color</label><br>
                                                                <input type="color" id="color" name="color" required
                                                                    style="width:100%">
                                                                @error('color')
                                                                <div
                                                                    class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <label for="availability-status">Status</label><Br>
                                                                <input type="checkbox" id="availability" name="availability" value="1" checked
                                                                    style="vertical-align: middle; height: 15px; width: 15px">
                                                                <label for="availabilityBox" style="font-size: 1rem; vertical-align: middle;">Available</label>
                                                            </td>
                                                        </tr>
                                                    </tbody>  
                                                </table>
                                                                <br><div class="col-md-2 text-md-right">
                                                                    <button type="submit"
                                                                        class="btn btn-primary submit-btn">Submit</button>
                                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div> <!-- End Table Row -->

                            <!-- Update Component Form Modal -->
                            <div class="modal fade" id="editComponentModal" tabindex="-1" role="dialog" aria-labelledby="editComponentModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editComponentModalLabel">Update Component</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                
                                            </button>
                                        </div>
                                        <form id="editComponentForm" method="POST"
                                            action="{{ route('updateComponents') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH') <!-- Use PATCH method for updating -->
                                            <div class="modal-body">
                                                <input type="hidden" id="editComponentId" name="id">
                                                <div class="form-group">
                                                    <label for="editComponentLayer">Layer</label>
                                                    <input type="text" class="form-control"
                                                        id="editComponentLayer" name="layer" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editComponentName">Name</label>
                                                    <input type="text" class="form-control"
                                                        id="editComponentName" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editComponentColor">Hex Color</label>
                                                    <div>
                                                        <span class="color-box-2"></span>
                                                        <input type="text" class="form-control" id="editComponentColor" name="color" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="availability-status">Status</label><Br>
                                                    <input type="checkbox" id="editComponentAvailability" name="is_available" value="1"
                                                        style="vertical-align: middle; height: 15px; width: 15px">
                                                    <label for="editComponentAvailability" style="font-size: 1rem; vertical-align: middle;">Available</label>
                                                </div>

        
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            @include('admin.partials.footer')
            <!-- main-panel ends -->
        </div>

        <!-- page-body-wrapper ends -->
    </div>

    <!-- Product Image Modal -->
    <div class="modal fade" id="productImageModal" tabindex="-1" role="img" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <div class="modal-body" id="modal-body">
                    <img class="rounded mx-auto d-block" id="product-image" src="">
                </div>
            </div>
        </div>
    </div>
    <!-- Product Image Modal End -->

    <!-- plugins:js -->
    @include('admin.partials.script')

  

    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JS from a CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Javascript for Update Form Modal -->
    <script>
    $(document).ready(function () {
        // Handle the click event on the "Edit" button in the dropdown
        $('.edit-component').on('click', function () {
            var componentId = $(this).data('component-id');
            var componentLayer = $(this).data('component-layer');
            var componentName = $(this).data('component-name');
            var componentColor = $(this).data('component-color');
            var componentAvailability = $(this).data('component-availability');
            var defaultColor = $(this).data('default-color'); // Get the default color

            // Populate the modal form fields with category data
            $('#editComponentId').val(componentId);
            $('#editComponentLayer').val(componentLayer);
            $('#editComponentName').val(componentName);
            $('#editComponentColor').val(componentColor);

            // Set the default color value in the modal input field
            var editComponentColor = $('#editComponentColor');
            editComponentColor.val(componentColor);

            // Handle input change event for color input
            editComponentColor.on('input', function () {
                var colorValue = $(this).val();
                if (!colorValue) {
                    // If no input, display the default color
                    colorValue = defaultColor; // Use the default color from the attribute
                }
                $('.color-box-2').css('background-color', colorValue);
            });

            // Handle the availability checkbox
            var editComponentAvailability = $('#editComponentAvailability');
            editComponentAvailability.prop('checked', componentAvailability);

            // Show the modal dialog
            $('#editComponentModal').modal('show');
        });
    });


</script>



</body>

</html>
