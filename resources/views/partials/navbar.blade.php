<header class="main-header">
    <!-- Menu Wave -->
    <div class="menu_wave"></div>

    <!-- Main box -->
    <div class="main-box">
        <div class="menu-box">
            <div class="logo"><a href="\"><img src="images/logo.png" alt="" title=""></a></div>

            <!--Nav Box-->
            <div class="nav-outer clearfix">
                <!-- Main Menu -->
                <nav class="main-menu navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                        <ul class="navigation menu-left clearfix">
                            <li class="current dropdown"><a
                                    href="\">Home</a>
                                </li>

                                <li><a href="\">Customize</a>
                            </li>

                            <li class="dropdown"><a href="{{ route('about') }}">About Us</a>
                                <ul>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('chef') }}">The Passionate Baker</a></li>
                                </ul>
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
                            <li><a href="contact.html">Track Order</a></li>
                            <li><a href="{{ route('contact') }}">Contacts</a></li>

                        </ul>
                    </div>
                </nav>
                <!-- Main Menu End-->
                <!-- Header 2 - Cart,login etc.-->




                <div class="outer-box clearfix">
                    <!-- Login-Register -->
                    <div class="login-register">
                        @if (Route::has('login'))
                            <!-- will redirect to assigned views once a user is logged in -->
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>

                                <!-- logout -->
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-4 text-sm text-gray-700 underline">Register</a>
                                @endif
                            @endauth

                        @endif
                    </div>

                    <!-- Shoppping Cart -->

                    <div class="cart-btn">

                        <a href="shopping-cart.html"><i class="icon flaticon-commerce"></i> <span
                                class="count">2</span></a>

                        <div class="shopping-cart">
                            <ul class="shopping-cart-items">
                                <li class="cart-item">
                                    <img src="https://via.placeholder.com/300x300" alt="#" class="thumb" />
                                    <span class="item-name">Birthday Cake</span>
                                    <span class="item-quantity">1 x <span class="item-amount">$84.00</span></span>
                                    <a href="shop-single.html" class="product-detail"></a>
                                    <button class="remove-item"><span class="fa fa-times"></span></button>
                                </li>

                                <li class="cart-item">
                                    <img src="https://via.placeholder.com/300x300" alt="#" class="thumb" />
                                    <span class="item-name">French Macaroon</span>
                                    <span class="item-quantity">1 x <span class="item-amount">$13.00</span></span>
                                    <a href="shop-single.html" class="product-detail"></a>
                                    <button class="remove-item"><span class="fa fa-times"></span></button>
                                </li>
                            </ul>

                            <div class="cart-footer">
                                <div class="shopping-cart-total"><strong>Subtotal:</strong> $97.00</div>
                                <a href="cart.html" class="theme-btn">View Cart</a>
                                <a href="checkout.html" class="theme-btn">Checkout</a>
                            </div>
                        </div>
                        <!--end shopping-cart -->
                    </div>

                    <!-- Search Btn -->
                    <div class="search-box">
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                    </div>


                </div>

                <!-- Sticky Header  -->
                <div class="sticky-header">
                    <div class="auto-container clearfix">
                        <!--Logo-->
                        <div class="logo">
                            <a href="#" title="Sticky Logo"><img src="images/logo-small.png"
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
                    <div class="logo"><a href="index.html"><img src="images/logo-small.png" alt=""
                                title=""></a></div>

                    <!--Nav Box-->
                    <div class="nav-outer clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </div>
                </div>

                <!-- Mobile Menu  -->
                <div class="mobile-menu">
                    <nav class="menu-box">
                        <div class="nav-logo"><a href="index.html"><img src="images/logo-small.png" alt=""
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
                                <input type="search" name="search-field" value="" placeholder="Search..."
                                    required="">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Header Search -->

</header>
