<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="/"><img src="{{ asset('admin/assets/images/logo.png') }}"
        alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="/redirect"><img src="{{ asset('admin/assets/images/logo.png') }}"
        alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="{{ asset('admin/assets/images/faces/face.jpg') }}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">

            @if (auth()->check())
            <h5 class="mb-0 font-weight-normal">{{ auth()->user()->firstname }}</h5>
            @endif

            <span>
              @php
              $userType = auth()->user()->role_id;
              @endphp

              @if ($userType == '1')
              <p>Adminstrator</p>
              @elseif($userType == '3')
              <p>Manager</p>
              @else
              <p>Staff</p>
              @endif
            </span>

          </div>
        </div>
        <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout-variant"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Logout</p>
            </div>
          </a>
          <!-- Form - logout function-->
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="/redirect">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
        <span class="menu-icon">
          <i class="mdi mdi-basket"></i>
        </span>
        <span class="menu-title">Orders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="orders">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('activeOrders') }}">Active Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('customOrders') }}">Customize Orders Section</a></li>
          <li class="nav-item"><a class="nav-link" href="">Order History</a></li>
          <li class="nav-item"><a class="nav-link" href="">Add Order</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
        <span class="menu-icon">
          <i class="mdi mdi-account"></i>
        </span>
        <span class="menu-title">User Management</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="users">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('user.list') }}">Users</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('user.form') }}">Add User</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
        <span class="menu-icon">
          <i class="mdi mdi-view-list"></i>
        </span>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('viewReview') }}">Reviews</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewCategories') }}">Category</a></li>
          <li class="nav-item"><a class="nav-link" href="">Tags</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewProducts') }}">View Products</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.viewAddProducts') }}">Add a product</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Gallery</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="admin/pages/ui-features/buttons.html">Buttons</a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="admin/pages/ui-features/dropdowns.html">Dropdowns</a></li>
          <li class="nav-item"> <a class="nav-link" href="admin/pages/ui-features/typography.html">Typography</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="admin/pages/tables/basic-table.html">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Reports</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="admin/pages/charts/chartjs.html">
        <span class="menu-icon">
          <i class="mdi mdi-chart-bar"></i>
        </span>
        <span class="menu-title">Charts</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-icon">
          <i class="mdi mdi-security"></i>
        </span>
        <span class="menu-title">Settings</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="admin/pages/samples/blank-page.html"> System
            </a></li>
          <li class="nav-item"> <a class="nav-link" href="admin/pages/samples/error-404.html"> API </a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="admin/pages/samples/error-500.html"> 3rd Party Tools </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
</nav>