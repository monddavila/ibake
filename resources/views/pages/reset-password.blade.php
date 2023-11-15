<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tier's of Joy | Recover Account</title>

    <!-- Header Section -->
    @include('partials.head')
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        @include('partials.preloader')

        <!-- Navbar -->
        @include('partials.navbar')

        <!--Page Title-->
        <section class="page-title" style="background-image:url({{ asset('images/background/background-6.jpg') }})">
            <div class="auto-container">
                <h1>Reset Password</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Reset Password</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="auto-container" style="margin-bottom: 100px">
                <div class="sec-title text-center">
                <div class="divider"><img src="{{ asset('images/icons/divider_1.png') }}" alt=""></div>
                    <h2>Reset your Password</h2>
                    <div class="text">
                    We'll help you get back into your account in no time.
                    </div>
                </div>

                        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Change Password</h4>
                                            @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                            @endif
                                        <p class="card-description">Password Information</p>

                                        <form class="forms-sample" action="{{ route('resetPasswordPost') }}" method="POST">
                                            @csrf

                                            <input type="text" name="token" value="{{$token}}" hidden>
                                
                                            <div class="form-group">
                                            <span style="color:grey"> At least 8 characters, one uppercase and lowercase letter, and no spaces.</span><br>
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
                                            <div>
                                            <button type="submit" class="btn btn-primary me-2" onclick="return confirm('Are you sure you want to change your account password?')">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

      

            
            </div>

    </div>
    </section>
    <!--End Contact Section -->


    <!-- Footer Section -->
    @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll-to-top')


    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('js/owl.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/appear.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/cart.js?v=' . filemtime(public_path('js/cart.js'))) }}"></script>


</body>

</html>