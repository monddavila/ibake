<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>

<body>
<div class="container-scroller">
    <!-- partial:sidebar -->
    @include('admin.partials.sidebar')

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
                    <li class="breadcrumb-item custom-breadcrumb">Settings</li>
                    <li class="breadcrumb-item custom-breadcrumb" aria-current="page">System</li>
                </ol>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">System Settings</h4>
                                <p class="card-description">System Information</p>

                                <form class="forms-sample" action="" method="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="updated">Website Name</label>
                                        <input type="text" class="form-control" id="updated"
                                               name="updated" value="iBake - Tier's of Joy">
                                        @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="updated">Business Email</label>
                                        <input type="text" class="form-control" id="updated"
                                               name="updated" value="teammed.amauonline@gmail.com">
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="updated">Business Name</label>
                                        <input type="text" class="form-control" id="updated"
                                               name="updated" value="iBake Tiers of Joy">
                                        @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> 
                                    <div class="form-group">
                                        <label for="updated">Business Representative</label>
                                        <input type="text" class="form-control" id="updated"
                                               name="updated" value="iBake Support">
                                        @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> 
                                    <div class="form-group">
                                        <label for="updated">Paymongo API Key</label>
                                        <input type="text" class="form-control" id="updated"
                                               name="updated" value="c2tfdGVzdF9mUUxqcDNaYmloMXJnVHh4bXVwMkx5ZGo6"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="updated">Tidio Chat Messaging Script</label>
                                        <input type="text" class="form-control" id="updated"
                                               name="updated" value="code.tidio.co/rxspxjqfeocjtadtyjrdmxudlhr0m8vc"  readonly>
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2" onclick="return confirm('Are you sure you want to modify system settings?')">Update</button>
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
@include('admin.partials.script')

<!-- JavaScript -->

</body>

</html>
