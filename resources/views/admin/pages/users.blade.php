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

        <!-- page breadcrumb-->
        <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item custom-breadcrumb">User Management</li>
                    <li class="breadcrumb-item custom-breadcrumb" aria-current="page">User List</li>
                </ol>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">User List</h4>
              <div class="d-flex justify-content-between align-items-center">
                <p class="card-description"> All User List </p>
                <a href="{{ route('user.form') }}" class="btn btn-primary me-2">+ Add User</a>
              </div>
              <div class="col-lg-2">
                <form class="mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search Users">
                </form>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Profile</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Contact No.</th>
                      <th>Created</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      // Assuming you have a $users variable containing the user data retrieved from the database
                      $users = \App\Models\User::all();
                      $count = 1;
                    @endphp
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $count++ }}</td>
                        <td class="py-1">
                          <img src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}"/>
                        </td>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td><label class="badge badge-danger">Pending</label></td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#">Profile</a>
                              <a class="dropdown-item" href="#">Edit</a>
                              <a class="dropdown-item" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')" href="{{ route('user.delete', ['id' => $user->id]) }}">Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- main-panel ends -->
  </div>

  <!-- plugins:js -->
  @include('admin.partials.script')
</body>
</html>
