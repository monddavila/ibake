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
        <section class="page-title" style="background-image:url(images/background/background-6.jpg">
            <div class="auto-container">
                <h1>Forgot Password</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Forgot Password</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="auto-container" style="margin-bottom: 100px">
                <div class="sec-title text-center">
                    <div class="divider"><img src="images/icons/divider_1.png" alt=""></div>
                    <h2>Recover your Account</h2>
                    <div class="text">
                    Forgot your password? Don't worry! Enter your email address and we'll send you a password reset link so you can create a new one.
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @elseif(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    

                            <div class="panel-heading">Forgot your password</div>
                            <div class="panel-body">
                                <form method="post" action="{{ route('forgotPasswordPost') }}">
                                    @csrf <!-- Laravel CSRF protection -->

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control" placeholder="Enter your Email Address" required>
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-envelope"></i> Send Reset Link
                                            </button>

                                            </span>
                                        </div>
                                       
                                        
                                    </div>
                                </form>
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


    <script src="js/select2.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/cart.js?v={{ filemtime(public_path('js/cart.js')) }}"></script>

</body>

</html>