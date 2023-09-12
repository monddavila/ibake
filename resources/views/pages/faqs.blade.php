<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tier's of Joy | FAQs</title>

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
                <h1>FAQs</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">home</a></li>
                    <li>FAQs</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

         <!-- Sec title -->
         <div class="sec-title text-center margin-top-50">
                <div class="divider"><img src="images/icons/divider_1.png" alt=""></div>
                <h2>Frequently Asked Questions</h2>
            </div>

        <!-- FAQs Section -->
        <section class="contact-section">
            <div class="auto-container">

            <div class="sec-faq margin-top-0">
                    <!--Accordian Box-->
                    <ul class="accordion-box">

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>Where is your shop located?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">You can place orders online, but you can still visit our physical store at 35 National Road, Brgy. Sta. Rosa, Bayombong, Nueva Vizcaya, 3700. For your convenience, here's a link to our location on Google Maps: <a href='https://goo.gl/maps/XtUzXry1pdDA2wmc6' target='_blank' style='color: black;'>Click here for directions</a>
.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block active-block">
                            <div class="acc-btn active"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>What services does iBake offer?</div>
                            <div class="acc-content current">
                                <div class="content">
                                    <div class="text">iBake offers a variety of products including pastries, tub cakes, cake pops, cupcakes, cookies, desserts, custom cakes, occasion cakes, wedding cakes, small cakes, and customize cake.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>What is the "Customize Your Cake" feature?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">The "Customize Your Cake" feature is a feature that allows customers to create a personalized cake that perfectly fits their occasion and taste, right from the comfort of their own device. Customers can design their dream cake with ease and the bakery will bring it to life with high-quality ingredients and expert craftsmanship 
                                    <a href="{{ route('customize') }}" style='color: black;'>Customize your own cake here!</a>  </div>
                                </div>
                            </div>
                        </li>
                        
                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>How can I place an order for cakes and pastries online?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">You can easily place an order on our website by browsing our menu, selecting the items you want, and adding them to your cart. Then, proceed to checkout and follow the steps to complete your order.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>Is there a minimum order requirement for online orders?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">We does not have a minimum order requirement, so you can order as little or as much as you'd like.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>How can I pay for my online order?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">We accept various payment methods, including credit cards, debit cards, and online payment platforms. You can choose your preferred payment method during checkout.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>Can I schedule my online order for a specific date and time?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Yes, you can schedule your order for a specific date and time during the checkout process. This is especially useful for events or celebrations.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>What is your delivery area, and is there a delivery fee?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">We have a designated delivery area, and there may be a delivery fee based on your location. You can check if we deliver to your address and view the delivery fee on our website.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>Do you offer pickup options for online orders?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Yes, we offer a pickup option for online orders. You can select this option during checkout, and we will provide you with the pickup details.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>How far in advance should I place my online order?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">It's recommended to place your online order at least 2-4 days in advance to ensure availability, especially for custom cakes and large orders. However, some items may be available for same-day ordering.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>What is your cancellation and refund policy for online orders?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Please refer to our website's cancellation and refund policy for detailed information on this topic. Generally, cancellations made within a certain time frame are eligible for a refund or store credit.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>Can I make changes to my order after it has been placed?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Changes to your order may be possible depending on the timing and nature of the changes. Please contact our customer support team as soon as possible to inquire about making modifications.</div>
                                </div>
                            </div>
                        </li>

                        <!--Block-->
                        <li class="accordion block">
                            <div class="acc-btn"><div class="icon-outer"><span class="icon fa fa-plus"></span> </div>Is my personal information and payment data secure when ordering online?</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Yes, we take security seriously. We use encryption and follow best practices to protect your personal information and payment data. Your privacy and security are important to us.</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            
        </section>
        <!--End Contact Section -->


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
