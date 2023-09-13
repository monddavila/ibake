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
                        @csrf

                        <div class="row clearfix">

                            <div class="column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">

                                    {{-- First Name --}}
                                    <div class="form-group">
                                        <x-label for="firstname" value="{{ __('First Name*') }}" />
                                        <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname"
                                            :value="old('firstname')" placeholder="First Name" required autofocus />
                                        @error('firstname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Last Name --}}
                                    <div class="form-group">
                                        <x-label for="lastname" value="{{ __('Last Name*') }}" />
                                        <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname"
                                            :value="old('lastname')" placeholder="Last Name" required autofocus />
                                    </div>

                                    {{-- User email --}}
                                    <div class="form-group">
                                        <x-label for="email" value="{{ __('Email*') }}" />
                                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            placeholder="Valid Email Adress" required autofocus />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- User Passsword --}}
                                    <div class="form-group">
                                        <x-label for="password" value="{{ __('Password*') }}" />
                                        <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                            required />
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Password Confirmation --}}
                                    <div class="form-group">
                                        <x-label for="password_confirmation" value="{{ __('Confirm Password*') }}" />
                                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                        placeholder="Re-type Password" name="password_confirmation" required />
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- User Phone --}}
                                    <div class="form-group">
                                        <x-label for="phone" value="{{ __('Phone*') }}" />
                                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" placeholder="11 Digit Phone Number" required
                                            autofocus />
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- User Address --}}
                                    <div class="form-group">
                                        <x-label for="" value="{{ __('Address*') }}" />
                                        <x-input id="address" class="block mt-1 w-full" type="text" name="address" placeholder="Mailing Address" required
                                            autofocus />
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                        @if (session('success'))
                            <div class="text-success">
                                {{ session('success') }}
                            </div>
                        @endif
                </div>
                <!--End Regiter Form -->
            </div>
        </section>
        <!--End Regiter Section-->

        <!-- Footer Section -->
        @include('partials.footer')
</body>

</html>
