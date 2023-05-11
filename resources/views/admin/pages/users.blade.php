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
              <h3 class="page-title"> Users </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">User Management</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
              </nav>
            </div>

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>
                    <p class="card-description"> Add class <code>.table</code>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Profile</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>VatNo.</th>
                            <th>Created</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="py-1">
                              <img src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}"/>
                            </td>
                            <td>Jacob</td>
                            <td>Daniels</td>
                            <td>53275531</td>
                            <td>12 May 2017</td>
                            <td><label class="badge badge-danger">Pending</label></td>
                          </tr>
                          <tr>
                            <td class="py-1">
                                <img src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}"/>
                            </td>
                            <td>Jacob</td>
                            <td>Daniels</td>
                            <td>53275531</td>
                            <td>12 May 2017</td>
                            <td><label class="badge badge-danger">Pending</label></td>
                          </tr>
                          
                        </tbody>
                      </table>
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