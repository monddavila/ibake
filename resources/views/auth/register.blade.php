<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>iBake | Register</title>

<!-- Header Section -->
@include('FrontEnd.header')
@include('FrontEnd.header2')

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
        <div class="auto-container">
            <h1>Create Account</h1>
            <ul class="page-breadcrumb">
                <li><a href="\">home</a></li>
                <li>Register</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!--Register Section-->

    <x-validation-errors class="mb-4" />

    <section class="login-section">
        <div class="auto-container">
            <!-- Registration Form -->
            <div class="login-form">
                <h2>Register</h2>
                <!--Register Form-->
                <form method="post" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="form-group">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="form-group"> <!--To be revised to fix the form-->
                    <x-label for="phone" value="{{ __('Phone') }}" />
                    <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autocomplete="phone" />
                </div>

                <div class="form-group">
                    <x-label for="address" value="{{ __('Address') }}" />
                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address" />
                </div>

                <div class="form-group">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="form-group">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                
                
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
            </div>
            <!--End Register Form -->  
        </div>
    </section>
    <!--End Registration Section-->

<!-- Footer Section -->
@include('FrontEnd.footer') 
 
</body>
</html>