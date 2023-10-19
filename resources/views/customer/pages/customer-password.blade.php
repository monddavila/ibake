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
                    <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Change Password</li>
                </ol>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Change Password</h4>
                                <p class="card-description">Password Information</p>

                                <form class="forms-sample" action="{{ route('updateCustomerPassword')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="current-password">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password"
                                        placeholder="Enter current password">
                                        @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter new password">
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm New Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>  
                                    <div class="form-group">
                                        <label for="updated">Last Updated</label>
                                        <input type="text" class="form-control" id="updated"
                                               name="updated" value="{{$user->updated_at->format('d-F-Y g:i A')}}"  readonly>
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirm('Are you sure you want to change your account password?')">Update</button>
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
    </div>

    <!-- page-body-wrapper ends -->
</div>
<!-- plugins:js -->
@include('customer.partials.script')

<!-- JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
