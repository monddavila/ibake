<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tier's of Joy | Track Order</title>

    <!-- Header Section -->
    @include('partials.head')
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        @include('partials.preloader')

        <!-- Navbar -->
        @include('partials.navbar')

        <!--Page Title-->
        <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
            <div class="auto-container">
                <h1>Track Order</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">home</a></li>
                    <li>Track Order</li>
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
                    <div class="text">Got a question or need help placing an order? Our friendly customer service team
                        is
                        here to assist you! Get in touch with us through our convenient contact page, where you can
                        easily
                        send us a message, give us a call, or connect with us on social media.
                        <br> We're dedicated to making your cake ordering experience as smooth and enjoyable as
                        possible,
                        and we're always happy to hear from our customers. So don't hesitate to reach out - we're here
                        to
                        help!
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-column">
                            <div class="title">
                                <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
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
                                <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
                                <h4>Our Contacts</h4>
                            </div>

                            <ul class="contact-info">
                                <li>35 National Road, Brgy. Sta. Rosa, Bayombong, Nueva Vizcaya, 3700</li>
                                <li><a href="tel:+639064300383">+63 9064300383</a><br><a href="tel:12032842919">+1
                                        203-284-2919</a></li>
                                <li><a href="mailto:info@ibake.com">info@ibake.com</a><br> <a
                                        href="mailto:sales@ibake.com">sales@ibake.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form Column -->
                    <div class="column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="title">
                                <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
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
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1912.8948766379704!2d121.15385758690918!3d16.486180259974827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.
            1!3m3!1m2!1s0x3390441054d9917f%3A0x23559ab76b734b9d!2sNational%20Raad%2C%20Bayombong%2C%20Nueva%20Vizcaya!5e0!3m2!1sen!2sph!4v1679568602156!5m2!1sen!2sph
"></iframe>
        </section>
        <!-- End Map Section -->


        <!-- Footer Section -->
        @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll-to-top')

    <!--Google Map APi-->
    <script src="js/select2.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/script.js"></script>


</body>

</html>
