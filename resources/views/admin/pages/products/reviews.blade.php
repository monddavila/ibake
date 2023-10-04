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
                        <li class="breadcrumb-item custom-breadcrumb" aria-current="page">View Reviews</li>
                    </ol>
                </div>

                <div class="col-lg-11 grid-margin stretch-card mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Products Reviews</h4>
                                <a href="{{ route('admin.addProducts') }}" class="btn btn-primary btn-fw">+ Add Review</a>
                            </div>
                            <div class="col-lg-3">
                                <div class="add-product-td">
                                <form id="showReviewsForm" method="GET" action="{{ route('getReviews') }}">
                                    @csrf
                                    <label for="category" class="product-input-label">Select Product</label>
                                    <select class="js-example-basic-single" style="width: 100%" name="productId">
                                        <option value="">Choose Product</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @if(session()->has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session()->get('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary btn-fw mt-3">Show</button>
                                </form>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="sortable" id="user_id">Item</th>
                                            <th class="sortable" id="username">User Name</th>
                                            <th class="sortable" id="comment">Comment</th>
                                            <th class="sortable" id="rating">Rating</th>
                                            <th class="sortable" id="created">Created</th>
                                            <th class="sortable" id="updated">Updated</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <div id="reviews-container">
                                            @include('admin.pages.products.reviews-table')
                                        </div>
                                    </tbody>
                                </table>
                                <!-- Pagination Links -->
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
    <!-- CSS -->

    <!-- JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
