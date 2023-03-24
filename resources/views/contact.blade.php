<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tier's of Joy | Contact Us</title>
    @include('partials.head')
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        @include('partials.preloader')
        <!-- Main Header-->
        @include('partials.navbar')
        <!--End Main Header -->

        <!--Page Title-->
        <section class="page-title" style="background-image:url(https://via.placeholder.com/1920x400)">
            <div class="auto-container">
                <h1>Contacts</h1>
                <ul class="page-breadcrumb">
                    <li><a href="index.html">home</a></li>
                    <li>Contacts</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <div class="divider"><img src="images/icons/divider_1.png" alt=""></div>
                    <h2>Our Contacts</h2>
                    <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nisi et
                        dolor ornare pellentesque. Nullam porttitor,<br> odio id facilisis, mauris dolor rhoncus elit,
                        ultricies nulla eros at dui. In suscipit leo sagittis aliquam.</div>
                </div>

                <div class="row clearfix">
                    <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-column">
                            <div class="title">
                                <div class="icon"><img src="images/icons/icon-devider-gray.png" alt="">
                                </div>
                                <h4>Opening Hours</h4>
                            </div>

                            <ul class="contact-info">
                                <li>Monday – Friday <br>08:00 – 17:30</li>
                                <li>Saturday <br>09:00 – 16:00</li>
                                <li>Sunday <br>CLOSED</li>
                            </ul>
                        </div>
                    </div>

                    <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12 order-3">
                        <div class="inner-column">
                            <div class="title">
                                <div class="icon"><img src="images/icons/icon-devider-gray.png" alt="">
                                </div>
                                <h4>Our Contacts</h4>
                            </div>

                            <ul class="contact-info">
                                <li>785 Carriage Drive, Jacksonville Beach, FL</li>
                                <li><a href="tel:12032842818">+1 203-284-2818</a><br><a href="tel:12032842919">+1
                                        203-284-2919</a></li>
                                <li><a href="mailto:info@your-site.com">info@your-site.com</a><br> <a
                                        href="mailto:sales@your-site.com">sales@your-site.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form Column -->
                    <div class="column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="title">
                                <div class="icon"><img src="images/icons/icon-devider-gray.png" alt="">
                                </div>
                                <h4>Send Message</h4>
                            </div>
                            <div class="contact-form">
                                <form action="#" method="post" id="email-form">

                                    <div class="form-group">
                                        <div class="response"></div>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="username" class="username"
                                            placeholder="Your Name *">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" class="email" placeholder="Your Email *">
                                    </div>

                                    <div class="form-group">
                                        <textarea name="contact_message" placeholder="Text Message"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="theme-btn" type="button" id="submit"
                                            name="submit-form">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Contact Section -->

        <!-- Map Section -->
        <section class="map-section">
            <iframe id="gmap_canvas"
                src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
        </section>
        <!-- End Map Section -->

        <!-- Main Footer -->
        @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll_to_up')

    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/script.js"></script>
    <!--End Google Map APi-->
</body>

</html>
