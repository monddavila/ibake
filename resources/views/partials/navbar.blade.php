<header class="main-header">
  <!-- Menu Wave -->
  <div class="menu_wave"></div>

  <!-- Main box -->
  <div class="main-box">
    <div class="menu-box">
      <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/ibake-logo/logo-small.png') }}"
            alt="ibake" title="ibake"></a>
      </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">
          <!-- Main Menu -->
          <nav class="main-menu navbar-expand-md navbar-light">
            <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
              <ul class="navigation menu-left clearfix">
                <li class="{{ currentNav('/') }}"><a href="{{ route('home') }}">Home</a>
                </li>

                <li class="{{ currentNav('/customize') }}"><a href="{{ route('customize') }}">Customize</a>
                </li>

                <li class="{{ currentNav('/about') || currentNav('/chef') }}
                                      dropdown">
                  <a href="{{ route('about') }}">About Us</a>
                  <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('chef') }}">The Passionate Baker</a></li>
                  </ul>
                </li>
                <li class="{{ currentNav('/gallery') || currentNav('/portfolio') }}
                                      dropdown">
                  <a href="{{ route('gallery') }}">Gallery</a>
                  <ul>
                    <li><a href="{{ route('gallery') }}">Featured Products</a></li>
                    <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                  </ul>
                </li>
              </ul>

              <ul class="navigation menu-right clearfix">
                <li class="{{ currentNav('/blog') }}"><a href="{{ route('blog') }}">Blog</a></li>

                <li class="{{ currentNav('/shop') }} dropdown"><a href="{{ route('shop') }}">Shop</a>
                  @auth
                  <ul>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('showCart') }}">Cart</a></li>
                    <?php if (Auth::user()->role_id == 2): ?>
                    <li><a href="{{ route('customer') }}">My Orders</a></li>
                    <?php endif ?>
                  </ul>
                  @endauth
                </li>
                <li class="{{ route('track') }}"><a href="{{ route('track') }}">Track Order</a></li>
                <li class="{{ currentNav('/contact') || currentNav('/faqs') }}
                                      dropdown">
                  <a href="{{ route('contact') }}">Contact</a>
                  <ul>
                    <li><a href="{{ route('contact') }}">Message Us</a></li>
                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                  </ul>
                </li>

              </ul>
            </div>
          </nav>
          <!-- Main Menu End-->

          <div class="outer-box clearfix">
                          @auth
                          <div class="row">
                            <div class="col-12 col-md-3 align-self-start">
                              <!-- Shoppping Cart -->
   
                              <div class="cart-btn">
                                  <a href="{{ route('showCart') }}"><i class="icon flaticon-commerce"></i> <span class="count">{{$cartItemCount}}</span></a>

                                  <div class="shopping-cart">
                                    <!--shopping cart content loaded in ajax -->
                                  </div> 
                              </div>
                              
                            </div>
                          @endauth
                        <!-- Login/Register Start-->
                            @auth
                              <div class="col-12 col-md-9 align-self-start">
                                <!-- Logged in -->
                                <?php if (Auth::user()->role_id == 1): ?>
                                  <a href="{{ route('redirect') }}" style="margin-right:10px;" class="theme-btn auth-btn"><i class="fa fa-dashboard"></i> Admin Panel</a>
                                <?php elseif(Auth::user()->role_id == 2): ?>
                                  <a href="{{ route('customer') }}" style="margin-right:10px;" class="theme-btn auth-btn"><i class="fa fa-user"></i> My Account</a>
                                <?php elseif(Auth::user()->role_id == 3): ?>
                                  <a href="{{ route('redirect') }}" style="margin-right:10px;" class="theme-btn auth-btn"><i class="fa fa-dashboard"></i> Admin Panel</a>
                                <?php endif ?>
                                {{-- Logout only works in a form --}}
                                <form method="POST" action="{{ route('logout') }}">
                                  @csrf
                                  <button class="theme-btn auth-btn" type="submit"><i class="fa fa-sign-out"></i> Logout</button>
                                </form>
                            </div>
                          </div>
                            @else
                            <!-- Not Logged in -->
                            <a href="{{ route('login') }}" style="margin-right:10px;" class="theme-btn auth-btn"><i class="fa fa-sign-in"></i> Log in</a>
                            <a href="{{ route('register') }}" class="theme-btn auth-btn"><i class="fa fa-user-plus"></i> Register</a>
                            @endauth
                            
                        <!-- Login/Register End-->
          </div>
        </div>
      <!-- Nav Box End -->
    </div>
  </div>
  <!-- Main box End-->


  <!-- Sticky Header  -->
  <div class="sticky-header">
    <div class="auto-container clearfix">
      <!--Logo-->
      <div class="logo">
        <a href="{{ route('home') }}" title="Sticky Logo"><img src="{{ asset('images/logo-small.png') }}" alt="Sticky Logo"></a>
      </div>

      <!--Nav Outer-->
      <div class="nav-outer">
        <!-- Main Menu -->
        <nav class="main-menu">
          <!--Keep This Empty / Menu will come through Javascript-->
        </nav><!-- Main Menu End-->
      </div>
    </div>
  </div><!-- End Sticky Menu -->

  <!-- Mobile Header -->
  <div class="mobile-header">
    <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-small.png') }}" alt="" title=""></a></div>

    <!--Nav Box-->
    <div class="nav-outer clearfix">
      <!--Keep This Empty / Menu will come through Javascript-->
    </div>
  </div>

  <!-- Mobile Menu  -->
  <div class="mobile-menu">
    <nav class="menu-box">
      <div class="nav-logo"><a href="{{ route('home') }}"><img src="{{ asset('images/ibake-logo/logo-small.png') }}" alt=""
            title=""></a></div>
      <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
    </nav>
  </div><!-- End Mobile Menu -->

  <!-- Header Search -->
  <div class="search-popup">
    <span class="search-back-drop"></span>

    <div class="search-inner">
      <button class="close-search"><span class="fa fa-times"></span></button>
      <form method="post" action="blog-showcase.html">
        <div class="form-group">
          <input type="search" name="search-field" value="" placeholder="Search..." required="">
          <button type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>
  <!-- End Header Search -->

</header>