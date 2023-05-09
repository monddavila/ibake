<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tier's of Joy | Register</title>

    <!-- Header Section -->
    @include('partials.head')
</head>

    <!-- Nabvar Section -->
    @include('partials.navbar')

<body>

    <div class="page-wrapper">
        

        <!--Regiter Section-->

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!--Page Title-->
        <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
            <div class="auto-container">
                <h1>Create an account</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">home</a></li>
                    <li>My account</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

        <section class="login-section">
            <div class="auto-container">
                <!-- Regiter Form -->
                <div class="login-form">
                    <h2>Create Account</h2>
                    <h7>(*) indicates required fields.</h7>
                    <!--Regiter Form-->
                    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="row clearfix">

                            <div class="column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    @csrf

                                    {{-- First Name --}}
                                    <div class="form-group">
                                        <x-label for="firstname" value="{{ __('First Name*') }}" />
                                        <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname"
                                            :value="old('firstname')" required autofocus />
                                    </div>

                                    {{-- Last Name --}}
                                    <div class="form-group">
                                        <x-label for="lastname" value="{{ __('Last Name*') }}" />
                                        <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname"
                                            :value="old('lastname')" required autofocus />
                                    </div>

                                    {{-- User email --}}
                                    <div class="form-group">
                                        <x-label for="email" value="{{ __('Email*') }}" />
                                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" required
                                            autofocus />
                                    </div>

                                    {{-- User Passsword --}}
                                    <div class="form-group">
                                        <x-label for="password" value="{{ __('Password*') }}" />
                                        <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                            required />
                                    </div>

                                    {{-- Password Confirmation --}}
                                    <div class="form-group">
                                        <x-label for="password_confirmation" value="{{ __('Confirm Password*') }}" />
                                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                            name="password_confirmation" required />
                                    </div>

                                    {{-- User Phone --}}
                                    <div class="form-group">
                                        <x-label for="phone" value="{{ __('Phone*') }}" />
                                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" required
                                            autofocus />
                                    </div>

                                    {{-- User Address --}}
                                    <div class="form-group">
                                        <x-label for="" value="{{ __('Address*') }}" />
                                        <x-input id="address" class="block mt-1 w-full" type="text" name="address" required
                                            autofocus />
                                    </div>

                                    {{-- Submit button/Register Account --}}
                                    <div class="form-group">
                                        <input class="theme-btn" type="submit" name="submit-form" value="register">
                                    </div>

                                    <p class="sign-up text-center">Already have an Account?<a href="{{ route('login') }}"> Sign In</a></p>
                                    <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>

                                </div>
                            </div>
                        </div>    
                    </form>
                </div>
                <!--End Regiter Form -->
            </div>
        </section>
        <!--End Regiter Section-->

        <!-- Footer Section -->
        @include('partials.footer')
</body>

</html>
