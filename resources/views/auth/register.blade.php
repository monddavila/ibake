<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake | Register</title>
    @include('partials.head')
</head>

<body>

    <div class="page-wrapper">
        @include('partials.navbar')

        <!--Regiter Section-->

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!--Page Title-->
        <section class="page-title" style="background-image:url(https://via.placeholder.com/1920x400)">
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
                    <!--Regiter Form-->
                    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- User Name --}}
                        <div class="form-group">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('email')" required autofocus />
                        </div>

                        {{-- User email --}}
                        <div class="form-group">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" required
                                autofocus />
                        </div>

                        {{-- User Passsword --}}
                        <div class="form-group">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required />
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="form-group">
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                        </div>

                        {{-- User Phone --}}
                        <div class="form-group">
                            <x-label for="phone" value="{{ __('Phone') }}" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" required
                                autofocus />
                        </div>

                        {{-- User Address --}}
                        <div class="form-group">
                            <x-label for="" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" required
                                autofocus />
                        </div>

                        {{-- Submit button/Register Account --}}
                        <div class="form-group">
                            <input class="theme-btn" type="submit" name="submit-form" value="register">
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
