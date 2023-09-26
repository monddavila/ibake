<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iBake - Tier's of Joy | Gallery</title>

    <!-- Header Section -->
    @include('partials.head')

    <!-- Navbar -->
    @include('partials.navbar')

</head>
<body>
    
<div class="page-wrapper">

<!-- Preloader -->
@include('partials.preloader')


<!--Page Title-->
<section class="page-title" style="background-image:url(images/background/background-6.jpg)">
    <div class="auto-container">
        <h1>Featured Products</h1>
        <ul class="page-breadcrumb">
            <li><a href="index.html">home</a></li>
            <li>Featured Products</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!-- Portfolio Sections -->
<section class="portfolio-section alternate2 portfolio-with-filter">
    <div class="container-fluid">

        <!--MixitUp Galery-->
        <div class="mixitup-gallery">
            <!--Filter-->
            <div class="filters clearfix">
                <ul class="filter-tabs filter-btns clearfix">
                    <li class="filter active" data-role="button" data-filter="all">All 
                        <div class="filter_shape"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 850.4 217"><path d="M820.3,96.5c-33.3-20.8-83.5-4.6-118,7.6c-79.5,28.2-150.5,57.8-236.9,44.3C317.8,125.3,122.3-11.8,0,132 c26.4,33.4,64.5-8.1,92.5-18.4c37.9-14,78-14.8,117-5c85.2,21.6,154.1,81.5,242,99.4c43,8.8,93.1,13.5,135.9,1.4 c40.6-11.5,70-41.1,102.9-65.9c22.9-17.3,44-36.9,71.6-23.7c14.9,7.1,20.7,28.6,34.6,37.8c14.7,9.7,34.7,10.1,51,16 C852.6,138,854.8,118.1,820.3,96.5z M494.7,81.7c34.5,4.3,141.9,1.9,134.9-60.3C626.8-3.2,594.7-4.5,577.9,7 c-20.8,14.4-14.3,27.9-44.8,29c-71.9,2.6-145.4-21.3-218.1-21.3C310.4,53.5,463.4,77.9,494.7,81.7z"></path></svg></div>
                    </li>
                    @foreach ($categoryNames as $categoryName)
                        <?php
                        $categorySlug = str_replace(' ', '-', strtolower($categoryName));
                        ?>
                    <li class="filter" data-role="button" data-filter=".{{ $categorySlug }}">{{ $categoryName }}
                        <div class="filter_shape"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 850.4 217"><path d="M820.3,96.5c-33.3-20.8-83.5-4.6-118,7.6c-79.5,28.2-150.5,57.8-236.9,44.3C317.8,125.3,122.3-11.8,0,132 c26.4,33.4,64.5-8.1,92.5-18.4c37.9-14,78-14.8,117-5c85.2,21.6,154.1,81.5,242,99.4c43,8.8,93.1,13.5,135.9,1.4 c40.6-11.5,70-41.1,102.9-65.9c22.9-17.3,44-36.9,71.6-23.7c14.9,7.1,20.7,28.6,34.6,37.8c14.7,9.7,34.7,10.1,51,16 C852.6,138,854.8,118.1,820.3,96.5z M494.7,81.7c34.5,4.3,141.9,1.9,134.9-60.3C626.8-3.2,594.7-4.5,577.9,7 c-20.8,14.4-14.3,27.9-44.8,29c-71.9,2.6-145.4-21.3-218.1-21.3C310.4,53.5,463.4,77.9,494.7,81.7z"></path></svg></div>
                    </li>
                    @endforeach
                   
                </ul>
            </div>
            <div class="filter-list row">

                <!-- Portfolio Block -->
                @foreach ($products as $product)
                    <?php
                    $categoryFilter = $product->category->name;
                    // Naming class for filtering
                    $filterName = str_replace(' ', '-', strtolower($categoryFilter));
                    ?>
   
                <div class="portfolio-block-four all mix {{ $filterName }} col-lg-2 col-md-4 col-sm-6">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="{{ $product->image }}" alt=""></figure>
                            <div class="hover-effect">
                                <svg x="0px" y="0px" viewBox="79 -202.7 1000 1000">
                                    <path d="M5459-1110.4L579.1-202.7c10.7,0,21.6,1.5,32.5,4.4c22.3,6,41.3,17,58,26.6c11.9,6.9,23,13.3,31.1,15.5 c6.8,1.8,19.4,1.8,26.2,1.8h12.9c27.5,0,59.4,1.4,89.3,18.7c32.8,19,50.2,49.3,64.1,73.7c6.2,10.9,12.6,22.1,17.8,27.3 c5.9,5.9,17.1,12.3,28.9,19.1c24,13.8,53.8,31,72.2,63c18.6,32.3,18.5,67,18.4,94.8c0,13.5-0.1,26.1,2,33.7 c2.1,7.7,8.4,18.7,15.2,30.3c14,24.1,31.4,54.1,31.4,91.3c0,36.8-17.2,66.6-31,90.6c-6.9,11.9-13.3,23-15.5,31.1 c-1.6,6.1-1.9,16.3-1.9,26.9c5.5,35.9-0.9,71-18.5,101.6c-18.9,32.7-49.1,50-73.4,63.9c-11.4,6.5-22.5,12.9-27.8,18.2 c-5.9,5.9-12.3,17-19,28.7c-14,24.2-31.1,54.1-63.1,72.5c-29.5,17-60.5,18.5-89.7,18.5h-10.3c-10.6,0-21.6,0.2-28.4,2 c-7.6,2-18.5,6.5-30.1,13.2c-24.1,14-54,29.6-91.3,29.6H579c-36.8,0-66.6-15.3-90.6-29.2c-11.8-6.8-22.9-12.3-31-14.4 c-6-1.6-16.1-1.4-26.1-1.4l-12.8,0.3c-17.5,0-37.9-0.3-58.4-5.8c-11.2-3-21.4-7.1-31-12.7c-33-19.1-50.3-49.4-64.3-73.8 c-6.2-10.8-12.6-22-17.8-27.2c-5.9-5.9-17-12.3-28.8-19.1c-24-13.8-53.8-31-72.3-63c-18.6-32.3-18.5-67-18.4-94.9 c0-13.4,0.1-26.1-2-33.7c-2-7.7-8.4-18.6-15.2-30.2c-14-24.1-31.4-54-31.4-91.3c0-36.8,17.2-66.7,31.1-90.7 c6.8-11.8,13.3-22.9,15.4-31c1.9-7.2,1.9-20.1,1.8-32.6c-0.1-28.1-0.2-63.1,18.8-95.9c19-32.9,49.3-50.2,73.6-64.2 c10.9-6.2,22.1-12.7,27.3-17.9c5.9-5.9,12.3-17.1,19.2-28.9c13.8-24,31-53.8,62.9-72.2c29.5-17,60.3-18.5,89.3-18.5h11 c10,0,21.3-0.2,28.2-2c7.6-2.1,18.6-8.4,30.1-15.1c24.3-14.1,54.3-31.5,91.4-31.6l4856-83.7l64-2888l-12016,96l-16,7000l7344,32 l4760,96L5459-1110.4z M909.2,106.8c-10.2-17.7-28.5-28.3-46.3-38.5c-12.2-7.1-23.8-13.7-32.4-22.3c-8.1-8.1-14.5-19.3-21.3-31.2 C798.8-3.3,788.1-22,769.7-32.7s-40-10.6-60.8-10.5c-13.7,0.1-26.6,0.1-37.7-2.9c-11.8-3.2-23.3-9.8-35.6-16.9 C623-70.3,610-77.8,596.2-81.5c-5.6-1.5-11.3-2.4-17.1-2.4c-20.7,0-39.2,10.8-57,21.1c-12.1,7-23.5,13.7-35,16.8s-24.7,3-38.6,3 c-20.6-0.1-42-0.1-59.9,10.3c-17.7,10.2-28.3,28.6-38.5,46.3c-7.1,12.3-13.7,23.8-22.3,32.5c-8.1,8.1-19.4,14.6-31.2,21.4 c-18.1,10.4-36.8,21.1-47.4,39.5c-10.7,18.5-10.6,40-10.5,60.9c0,13.7,0.1,26.6-2.9,37.8c-3.2,11.8-9.8,23.3-16.9,35.5 C208.6,259,198,277.4,198,297.8c0,20.8,10.7,39.2,21.1,57.1c7,12.1,13.6,23.5,16.7,35c3.1,11.5,3,24.6,3,38.6 c-0.1,20.7-0.1,42,10.2,60.1c10.2,17.7,28.5,28.3,46.3,38.5c12.2,7.1,23.8,13.7,32.4,22.3c8.1,8.1,14.5,19.3,21.3,31.2 c10.4,18.2,21.1,36.9,39.5,47.5c5.1,2.9,10.6,5.2,16.7,6.8c14.1,3.8,29.3,3.7,44,3.7c13.8-0.1,26.7-0.1,37.8,2.9 c11.8,3.2,23.3,9.8,35.5,16.9c17.8,10.3,36.1,20.9,56.6,20.9c20.8,0,39.2-10.8,57-21.2c12.1-7,23.5-13.7,35-16.7 c11.5-3.1,24.6-3,38.6-3c20.7,0,42.1,0.1,60.1-10.3c17.7-10.2,28.4-28.6,38.6-46.3c7.1-12.3,13.9-23.8,22.5-32.4 c8.1-8.1,19.6-14.5,31.5-21.3c18.2-10.4,37.7-21.1,48.4-39.6c10.6-18.5,8.9-87.6,11.9-98.7c3.2-11.8,9.8-23.3,16.9-35.6 c10.3-17.8,20.9-36.1,20.9-56.6c0-20.8-10.7-39.2-21.1-57.1c-7-12.1-13.6-23.5-16.7-35c-3.1-11.5-3-24.7-3-38.7 C919.5,146.2,919.5,124.8,909.2,106.8z"></path>
                                </svg>
                                <a href="/shop/item/{{ $product->id }}" class="link"></a>
                            </div>
                        </div>

                        <div class="lower-content">
                            <div class="title-box">
                                <h3><a href="/shop/item/{{ $product->id }}"><svg class="div_left" viewBox="0 0 152 51"> <path d="M18,13.7c-2.3,0.6-11.9,3.9-8.4,0s11.9-2.2,16.2-1.6c10.8,1.7,20.2,6.1,29.7,11.2c10.6,5.8,21.3,11.1,31.4,17.7 c8.6,5.6,18.3,9.5,28.7,9.9c15.8,0.6,31.9-11.4,35.8-26.8c2-8-0.7-16.8-7.7-21.6c-10.6-7.3-14.3,2.7-16.2,11.6 c2.4-0.1,5.8-1.1,8-0.5c3,0.9,2.1,0.9,3.6,4.1c1.5,3.3,1.8,7,0.9,10.5c-2.5,9.4-13,15.2-22.1,15.9c-20.2,1.6-39.5-16.8-55.5-26.7 C48.8,9.2,22.4-8.4,6.6,4.7c-5.4,4.5-10,15.8-3.3,21.2C12.6,33.3,16.8,20.1,18,13.7z"></path></svg>{{ $product->name }}<svg class="div_right" viewBox="0 0 152 51"><path d="M134,13.7c2.3.55,11.86,3.93,8.38,0s-11.87-2.21-16.21-1.55C115.4,13.8,106,18.23,96.5,23.38,85.88,29.16,75.2,34.5,65.07,41.12c-8.57,5.6-18.31,9.45-28.66,9.86C20.56,51.61,4.49,39.55.64,24.17c-2-8,.72-16.81,7.74-21.63C19-4.73,22.65,5.27,24.55,14.15c-2.37-.14-5.8-1.11-8-.46-3,.87-2.06.91-3.64,4.11A16,16,0,0,0,12,28.29c2.45,9.4,13,15.18,22.12,15.89,20.17,1.56,39.46-16.81,55.54-26.67,13.57-8.32,40-25.86,55.71-12.86,5.44,4.5,10,15.83,3.29,21.24C139.41,33.33,135.18,20.06,134,13.7Z" transform="translate(0)"></path></svg></a></h3>
                            </div>
                            <!-- <div class="text">"{{ $product->item_description }}"</div>-->
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

       
    </div>
</section>
<!--End Projects Sections -->

<!-- Footer Section -->
@include('partials.footer')
</div><!-- End Page Wrapper -->

 <!-- Scroll To Top -->
 @include('partials.scroll-to-top')

<script src="js/jquery.js"></script> 
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/appear.js"></script>
<script src="js/mixitup.js"></script>
<script src="js/script.js"></script>

</body>
</html>