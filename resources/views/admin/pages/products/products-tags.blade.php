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
                        <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Category</li>
                    </ol>
                </div>

                <div class="col-lg-11 grid-margin stretch-card mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                @if(session()->has('message-2'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('message-2') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif
                                <h4 class="card-title">Categories List</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="sortable" id="sort-id" data-sort="name">ID</th>
                                                    <th class="sortable col-lg-3" id="sort-name" data-sort="name">Category
                                                        Name</th>
                                                    <th class="sortable" id="sort-description"
                                                        data-sort="description">Description</th>
                                                    <th class="sortable" id="sort-created"
                                                        data-sort="created">Created</th>
                                                    <th class="sortable" id="sort-updated"
                                                        data-sort="updated">Updated</th>

                                                </tr>
                                            </thead>
                                            @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td>{{ date('M-d-y', strtotime($category->created_at)) }}</td>
                                                <td>{{ date('M-d-y', strtotime($category->updated_at)) }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item edit-category"
                                                                href="javascript:void(0);"
                                                                data-category-id="{{ $category->id }}"
                                                                data-category-name="{{ $category->name }}"
                                                                data-category-description="{{ $category->description }}">Edit</a>
                                                            <a class="dropdown-item" class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this category?')"
                                                                href="{{ route('deleteCategory', ['id' => $category->id]) }}"style="color: red;">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tbody id='category-table-body'>

                                            </tbody>
                                        </table>
                                        <!-- Pagination Links -->
                                        {{ $categories->links() }}
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="container" style="margin-top: 10px;">
                                        <div><h3>Add New Category</h3></div>
                                        @if(session()->has('message-1'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session()->get('message-1') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                        @endif
                                        <form class="admin-add-category" method="POST"
                                            action="{{ route('addCategory') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="container" style="margin-bottom: 10px;">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <!-- Name Field -->
                                                                <label for="name"
                                                                    class="product-input-label">Category Name</label><br>
                                                                <input type="text" id="name" name="name" required
                                                                    style="width:100%">
                                                                @error('name')
                                                                <div
                                                                    class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <!-- Description Field -->
                                                                <label for="name"
                                                                    class="product-input-label">Short Description</label><br>
                                                                <textarea id="description" name="description" required
                                                                    style="width: 100%; height: 50px;"></textarea>
                                                                @error('description')
                                                                <div
                                                                    class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="col-md-2 text-md-right">
                                                                    <button type="submit"
                                                                        class="btn btn-primary submit-btn">Submit</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div> <!-- End Table Row -->

                            <!-- Update Category Form Modal -->
                            <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="editCategoryForm" method="POST"
                                            action="{{ route('updateCategory') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH') <!-- Use PATCH method for updating -->
                                            <div class="modal-body">
                                                <input type="hidden" id="editCategoryId" name="id">
                                                <div class="form-group">
                                                    <label for="editCategoryName">Category Name</label>
                                                    <input type="text" class="form-control"
                                                        id="editCategoryName" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editCategoryDescription">Description</label>
                                                    <textarea class="form-control" id="editCategoryDescription"
                                                        name="description" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
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
            $('.edit-category').on('click', function () {
                var categoryId = $(this).data('category-id');
                var categoryName = $(this).data('category-name');
                var categoryDescription = $(this).data('category-description');

                // Populate the modal form fields with category data
                $('#editCategoryId').val(categoryId);
                $('#editCategoryName').val(categoryName);
                $('#editCategoryDescription').val(categoryDescription);

                // Show the modal dialog
                $('#editCategoryModal').modal('show');
            });
        });
    </script>

</body>

</html>
