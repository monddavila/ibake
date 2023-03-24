<header class="main-header">
    <!-- Menu Wave -->
    <div class="menu_wave"></div>

    <!-- Main box -->
    <div class="main-box">
        <div class="menu-box">
            <div class="logo"><a href="{{ route('home') }}"><img src="images/logo.png" alt="" title=""></a>
            </div>

            <!--Nav Box-->
            <div class="nav-outer clearfix">
                <!-- Main Menu -->
                <nav class="main-menu navbar-expand-md navbar-light">
                    <!-- Left Navbar -->
                    <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                        <ul class="navigation menu-left clearfix">
                            <li class="{{ currentNav('/') }}"><a href="{{ route('home') }}">Home</a> </li>
                            <li class="dropdown"><a href="{{ route('home') }}">Customization</a> </li>
                            <li class="{{ currentNav('/about_us') }}"><a href="{{ route('about_us') }}">About Us</a>
                            </li>
                            <li class="dropdown"><a href="portfolio-masonry.html">Portfolio</a>
                                <ul>
                                    <li><a href="portfolio-masonry.html">Masonry</a></li>
                                    <li><a href="portfolio-masonry-wide.html">Masonry Wide</a></li>
                                    <li><a href="portfolio-wide.html">Wide</a></li>
                                    <li><a href="portfolio-with-filter.html">With Filter</a></li>
                                    <li><a href="portfolio-two-column.html">Two Columns</a></li>
                                    <li><a href="portfolio-with-sidebar.html">With Sidebar</a></li>
                                    <li><a href="portfolio-square.html">Square</a></li>
                                    <li><a href="portfolio-single.html">single Post</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- Left Navbar End -->

                        <!-- Right Navbar -->
                        <ul class="navigation menu-right clearfix">
                            <li class="dropdown"><a href="blog-showcase.html">Blog</a>
                                <ul>
                                    <li><a href="blog-showcase.html">Checkerboard</a></li>
                                    <li><a href="blog-standard.html">Standard</a></li>
                                    <li><a href="blog-masonry.html">Masonry</a></li>
                                    <li><a href="blog-masonry-full-width.html">Masonry Full Width</a></li>
                                    <li><a href="blog-two-column.html">Two Columns Grid</a></li>
                                    <li><a href="blog-three-column-wide.html">Three Columns Wide</a></li>
                                    <li class="dropdown"><a href="#">Post Types</a>
                                        <ul>
                                            <li><a href="blog-single.html">Standard Post</a></li>
                                            <li><a href="blog-single-2.html">Gallery Post</a></li>
                                            <li><a href="blog-single-3.html">Video Post</a></li>
                                            <li><a href="blog-single-4.html">Audio Post</a></li>
                                            <li><a href="blog-single-5.html">Quote Post</a></li>
                                            <li><a href="blog-single-6.html">Link Post</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="shop.html">Shop</a>
                                <ul>
                                    <li><a href="shop.html">Shop</a></li>
                                    <li><a href="shopping-cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="login.html">My account</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('contact') }}">Contacts</a></li>
                        </ul>
                        <!-- Right Navbar End -->
                    </div>
                </nav>
                <!-- Main Menu End-->

                <div class="outer-box clearfix">
                    <div class="auth-container">
                        @auth
                            <a href="{{ url('/dashboard') }}" style="margin-right:10px;"
                                class="theme-btn auth-btn">Dashboard</a>
                            {{-- Logout only works in a form --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="theme-btn auth-btn" type="submit">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" style="margin-right:10px;" class="theme-btn auth-btn">Log in</a>
                            <a href="{{ route('register') }}" class="theme-btn auth-btn">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <!--Logo-->
            <div class="logo">
                <a href="{{ route('home') }}" title="Sticky Logo"><img src="images/logo-small.png"
                        alt="Sticky Logo"></a>
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
        <div class="logo"><a href="{{ route('home') }}"><img src="images/logo-small.png" alt=""
                    title=""></a>
        </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">
            <!--Keep This Empty / Menu will come through Javascript-->
        </div>
    </div>

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <nav class="menu-box">
            <div class="nav-logo"><a href="{{ route('home') }}"><img src="images/logo-small.png" alt=""
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
