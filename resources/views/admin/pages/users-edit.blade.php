<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials.head')
</head>
<body>
<div class="container-scroller">
    <!-- partial:sidebar -->
    @include('admin.partials.sidebar')

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
                    <li class="breadcrumb-item custom-breadcrumb">User Management</li>
                    <li class="breadcrumb-item custom-breadcrumb" aria-current="page">Update user data</li>
                </ol>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update User Account</h4>
                                <p class="card-description"> User Information </p>

                                <form class="forms-sample" action="{{ route('user.update', $user->id) }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                         value="{{$user->firstname}}">
                                        @error('firstname')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                        value="{{$user->lastname}}">
                                        @error('lastname')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                        value="{{$user->email}}">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter new password">
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     
                                    <div class="form-group">
                                        <label for="account">Account Role</label>
                                        <select class="form-control" id="account" name="role_id" style="width:30%">
                                            @if ($role)
                                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                            @endif
                                            
                                            @foreach($roles as $roleOption)
                                                @if ($role && $roleOption->id === $role->id)
                                                    @continue
                                                @endif
                                                <option value="{{ $roleOption->id }}">{{ $roleOption->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{$user->phone}}">
                                        @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                        value="{{$user->address}}">
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <a href="{{ route('user.list') }}" class="btn btn-dark">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
</div>

<!-- plugins:js -->
@include('admin.partials.script')
</body>
</html>
