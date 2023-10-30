<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Forgot Password</title>
  @include('partials.head')
</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    @include('partials.preloader')

    <!-- Main Header-->
    @include('partials.navbar')

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
        <div class="auto-container">
            <h1>My account</h1>
            <ul class="page-breadcrumb">
                <li><a href="\">home</a></li>
                <li>Forgot Password</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
    <section class="content-box">


    
    <!--Forgotpass Section-->
        <section class="contact-section">
            <div class="auto-container">

                <div class="text">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <x-validation-errors class="mb-4" />
                <div class="contact-form">

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="form-group">
                        <button class="theme-btn" type="button" id="submit" name="submit-form">{{ __('Email Password Reset Link') }}</button>
                            
                        
                    </div>
                </div>
                </form>

            </div>
        </section>

    <!--End Forgotpass Section-->



<!-- Footer Section -->
 <!-- Main Footer -->
    @include('partials.footer')

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

</div>
 
</body>
</html>