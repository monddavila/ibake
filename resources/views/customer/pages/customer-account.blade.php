<!DOCTYPE html>
<html lang="en">

<head>
    @include('customer.partials.head')
</head>

<body>
<div class="container-scroller">
    <!-- partial:sidebar -->
    @include('customer.partials.sidebar')

    <div class="container-fluid page-body-wrapper">

    <!-- partial:navbar -->
    @include('customer.partials.navbar')

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
                    <li class="breadcrumb-item custom-breadcrumb">Settings</li>
                    <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Account Profile</li>
                </ol>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Account Profile</h4>
                                <p class="card-description">Personal Information</p>

                                <form class="forms-sample" action="{{ route('updateCustomerAccount', $user->id) }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                         value="{{$user->firstname}}">
                                        @error('firstname')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                        value="{{$user->lastname}}">
                                        @error('lastname')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                        value="{{$user->email}}">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{$user->phone}}">
                                        @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                        value="{{$user->address}}">
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="created">Account Created</label>
                                        <input type="text" class="form-control" id="created" name="created"
                                        value="{{$user->created_at->format('d-F-Y g:i A')}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="updated">Last Updated</label>
                                        <input type="text" class="form-control" id="updated"
                                               name="updated" value="{{$user->updated_at->format('d-F-Y g:i A')}}"  readonly>
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirm('Are you sure you want to update your account information?')">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © iBake Tiers of Joy
                    <?php echo date('Y'); ?><a href="{{ route('terms') }}"> Terms</a> | <a href="{{ route('privacy') }}">Privacy</a></span>
            </div>
        </footer>
        <!-- partial -->
        <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
</div>
</div>
<!-- plugins:js -->
@include('customer.partials.script')

<!-- JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//code.tidio.co/rxspxjqfeocjtadtyjrdmxudlhr0m8vc.js" async></script>
</body>

</html>
