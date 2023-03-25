<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake | Login</title>
    @include('partials.head')
</head>

<body>

    <div class="page-wrapper">
        @include('partials.navbar')

        <!--Login Section-->

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
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
                        </div>

                        <div class="form-group">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" />
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
</body>

</html>
