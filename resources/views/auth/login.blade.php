<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tier's of Joy | Login</title>

    <!-- Header Section -->
    @include('partials.head')
</head>

    <!-- Nabvar Section -->
    @include('partials.navbar')

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
        <div class="auto-container">
            <h1>My account</h1>
            <ul class="page-breadcrumb">
                <li><a href="\">home</a></li>
                <li>My account</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!--Login Section-->

    @if (session('status'))
<div class="mb-4
                            font-medium text-sm text-green-600">
                            {{ session('status') }}
            </div>
            @endif

            <section class="login-section">
                <div class="auto-container">
                    <!-- Login Form -->
                    <div class="login-form">
                        <h2>Login</h2>
                        <!--Login Form-->
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="current-password" />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input class="theme-btn" type="submit" name="submit-form" value="Log in">
                            </div>

                            <div class="form-group">
                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <p class="sign-up">Don't have an Account?<a href="{{ route('register') }}"> Sign Up</a></p>
                            <div class="form-group pass">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="psw">{{ __('Forgot your password?') }}</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <!--End Login Form -->
                </div>
            </section>
            <!--End Login Section-->

            <!-- Footer Section -->
            @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll-to-top')

    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/sticky_sidebar.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>
