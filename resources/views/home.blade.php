<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tier's of Joy | Home</title>
    @include('partials.head')
</head>

<body>
    <div class="page-wrapper">
        <!-- Homepage loading screen -->
        @include('partials.preloader')

        <!-- Navbar -->
        @include('partials.navbar')
        <!--Main Slider-->
        @include('partials.homepage.hero_header')

        <!-- Services Section -->
        @include('partials.homepage.specialties_banner')

        <!-- Cake Customization -->
        @include('partials.homepage.customization_banner')

        <!-- Portfolio Section -->
        @include('partials.homepage.portfolio')

        <!-- About Us Section -->
        @include('partials.homepage.about_us')

        {{--
          Recipes section will not be included as of now.
          The recipes section can be used if needed or for other purposes.
          Recipes section partial file is located
          ./resources/views/partials/hompage/recipes.blade.php
          The partial can be used by using
          @include('partials.homepage.recipes')
        --}}
        {{-- @include('partials.homepage.recipes') --}}


        <!-- Testimonial Section -->
        @include('partials.homepage.testimonials')

        <!-- Pricing Section -->
        @include('partials.homepage.pricing')
        <!--End Pricing Section -->

        <!-- Footer -->
        @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll_to_up')

    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--Revolution Slider-->
    <script src="plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script src="js/main-slider-script.js"></script>
    <!--Revolution Slider-->
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
