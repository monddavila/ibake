<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="plugins/revolution/css/settings.css" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="plugins/revolution/css/layers.css" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="plugins/revolution/css/navigation.css" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->

<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader_overlay"></div>
        <div class="loader_cogs">
            <div class="loader_cogs__top">
                <div class="top_part"></div>
                <div class="top_part"></div>
                <div class="top_part"></div>
                <div class="top_hole"></div>
            </div>
            <div class="loader_cogs__left">
                <div class="left_part"></div>
                <div class="left_part"></div>
                <div class="left_part"></div>
                <div class="left_hole"></div>
            </div>
            <div class="loader_cogs__bottom">
                <div class="bottom_part"></div>
                <div class="bottom_part"></div>
                <div class="bottom_part"></div>
                <div class="bottom_hole"></div>
            </div>
        </div>
    </div>
    
    <!-- Main Header-->
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
                                <li class="current dropdown"><a href="\">Home</a>
                                </li>

                                <li><a href="\">Customize</a></li>

                                <li class="dropdown"><a href="{{ route('about') }}">About Us</a>
                                    <ul>
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('staff') }}">Our Staff</a></li>
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