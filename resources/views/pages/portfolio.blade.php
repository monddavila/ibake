<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iBake - Tier's of Joy | Portfolio</title>

    <!-- Header Section -->
    @include('partials.head')

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Include the portfolio.js script -->
    <script src="js/jquery.js"></script>
    <script src="js/portfolio.js"></script>
    

</head>
<body>
    
<div class="page-wrapper">

<!-- Preloader -->
@include('partials.preloader')


<!--Page Title-->
<section class="page-title" style="background-image:url(images/background/background-6.jpg)">
    <div class="auto-container">
        <h1>Portfolio</h1>
        <ul class="page-breadcrumb">
            <li><a href="index.html">home</a></li>
            <li>Portfolio</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!-- Portfolio Sections -->
<section class="portfolio-section alternate2 portfolio-square">
    <div class="container-fluid">
        <div class="row" id="cakes-container">
            <!-- Images will be loaded here dynamically thru portfolio.js -->
        </div>

        <div class="btn-box text-center">
            <a href="#" class="theme-btn btn-style-two large" id="load-more"><span></span>Load More<span></span></a>
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