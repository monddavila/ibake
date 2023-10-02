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
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="user-search-input" placeholder="Search User"
                    aria-label="Search" aria-describedby="search-button">
                  <button class="btn btn-outline-secondary" type="button" id="reset-search-btn">Reset</button>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Profile</th>
                      <th class="sortable" id="sort-firstname" data-sort="firstname">First Name</th>
                      <th class="sortable" id="sort-lastname" data-sort="lastname">Last Name</th>
                      <th class="sortable" id="sort-role_id" data-sort="role_id">Role</th>
                      <th class="sortable" id="sort-email" data-sort="email">Email</th>
                      <th class="sortable" id="sort-phone" data-sort="phone">Contact No.</th>
                      <th class="sortable" id="sort-created" data-sort="created_at">Created</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id='users-table-body'>
                    @include('admin.pages.users-table')
                  </tbody>
                </table>
                  <!-- Pagination Links -->
                  {{ $users->links() }}
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
  <script src="{{ asset('admin/assets/js/admin-users.js') }}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
