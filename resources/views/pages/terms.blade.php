<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iBake - Tier's of Joy | Terms and Service</title>

    <!-- Header Section -->
    @include('partials.head')

    <style>
        /* Style the bullet points for the entire unordered list */
        ul {
            list-style-type: none; /* Remove default bullet points */
            margin-left: 0; /* Adjust the left margin for the bullet points */
        }

        /* Style the list items */
        li {
            margin: 10px 0; /* Add space between each list item */
            margin-left: 35px; /* Adjust the left margin for the bullet points */
        }

        /* Style the bullet points using the ::marker pseudo-element */
        li::marker {
            content: "• "; /* Set the bullet point to a filled circle */
            color: black; /* Set the color of the bullet points */
            font-size: 20px; /* Set the font size to make it larger */
        }

        /* Style all h3 elements */
        h3 {
            margin-bottom: 20px;
            margin-top: 30px;
        }
    </style>

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
                <h1>Terms and Service</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">home</a></li>
                    <li>Terms and Service</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

        <!-- Sec title -->
        <div class="sec-title text-center margin-top-50">
            <div class="divider"><img src="images/icons/divider_1.png" alt=""></div>
            <h2>iBake-Tier’s of Joy Terms and Service</h2>
        </div>

        <!-- Terms and Service Section -->
        <section class="contact-section">
            <div class="auto-container">
                <p>These terms and conditions govern the use of iBake-Tier’s of Joy. This site is owned and operated by Mr. Jan Kevin Camacho. This site is an ecommerce website.</p>
                <p>By using this Site, you indicate that you have read and understand these Terms and Conditions and agree to abide by them at all times.</p>

                <h3>Intellectual Property</h3>
                <p>All content published and made available on our Site is the property of Mr. Jan Kevin Camacho and the Site’s creators. This includes, but is not limited to images, text, logos, documents, downloadable files and anything that contributes to the composition of our Site.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Acceptable Use</h3>
                <p>As a user of our Site, you agree to use our Site legally, not to use our Site for illegal purposes, and not to:</p>
                <ul>
                    <li>Harass or mistreat other users of our Site;</li>
                    <li>Violate the rights of other users of our Site;</li>
                    <li>Violate the intellectual property rights of the Site owners or any third party to the Site;</li>
                    <li>Hack into the account of another user of the Site;</li>
                    <li>Act in any way that could be considered fraudulent; or</li>
                    <li>Post any material that may be deemed inappropriate or offensive.</li>
                </ul>
                <p>If we believe you are using our Site illegally or in a manner that violates these Terms and Conditions, we reserve the right to limit, suspend, or terminate your access to our Site. We also reserve the right to take any legal steps necessary to prevent you from accessing our Site.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>User Contributions</h3>
                <p>Users may post the following information on our Site:</p>
                <ul>
                    <li>Photos</li>
                    <li>Reviews</li>
                </ul>
                <p>By posting publicly on our Site, you agree not to act illegally or violate these Terms and Conditions.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Accounts</h3>
                <p>When you create an account on our Site, you agree to the following:</p>
                <ol>
                    <li>You are solely responsible for your account and the security and privacy of your account, including passwords or sensitive information attached to that account;</li>
                    <li>All personal information you provide us through your account is up-to-date, accurate, and truthful, and that you will update your personal information if it changes.</li>
                </ol>
                <p>We reserve the right to suspend or terminate your account if you are using our Site illegally or if you violate these Terms and Conditions.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Sale of Goods</h3>
                <p>These Terms and Conditions govern the sale of goods available on our Site.</p>
                <p>The following goods are available on our Site:</p>
                <ul>
                    <li>Cakes and Pastries</li>
                </ul>
                <p>These Terms and Conditions apply to all the goods that are displayed on our Site at the time you access it. This includes all products listed as being out of stock. All information, descriptions, or images that we provide about our goods are as accurate as possible. However, we are not legally bound by such information, descriptions, or images as we cannot guarantee of all goods we provide. You agree to purchase goods from our Site at your own risk.</p><br>
                <p>We reserve the right to modify, reject, or cancel your order whenever it becomes necessary. If we cancel your order and have already processed your payment, we will give you a refund equal to the amount you paid. You agree that it is your responsibility to monitor your payment instrument to verify receipt of any refund.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>User Goods and Services</h3>
                <p>Our Site allows users to sell goods and services. We do not assume any responsibility for the goods and services users sell on our Site. We cannot guarantee the quality or accuracy of any goods and services sold by users on our Site. However, if we are made aware that a user is violating these Terms and Conditions, we reserve the right to suspend or prohibit the user from selling goods and services on our Site.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Payments</h3>
                <p>We accept the following payment methods on our Site:</p>
                <ul>
                    <li>Credit Card</li>
                    <li>Debit</li>
                    <li>Gcash and Paymaya</li>
                </ul>
                <p>When you provide us with your payment information, you authorize our use of and access to the payment instrument you have chosen to use. By providing us with your payment information, you authorize us to charge the amount due to this payment instrument.</p>
                <p>If we believe your payment has violated any law or these Terms and Conditions, we reserve the right to cancel or reverse your transaction.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Shipping and Delivery</h3>
                <p>When you purchase goods from our Site, the goods will be delivered through one of the following methods:</p>
                <ul>
                    <li>Standard Delivery depending on location</li>
                </ul>
                <p>Delivery will take place as soon as reasonably possible, depending on the delivery method selected. Delivery times may vary due to unforeseen circumstances. Please note that delivery times do not include weekends or statutory holidays.</p>
                <p>You will be required to pay delivery charges in addition to the price for the goods you purchase.</p><br>
                <p>You are required to provide us with a complete and accurate delivery address, including the name of the recipient. We are not liable for the delivery of your goods to the wrong address or wrong person as a result of you providing us with inaccurate or incomplete information.</p>
                <div class="cws_divider margin-bottom-20"></div>
                
                <h4>Refunds for Goods</h4>
                <p>Refund requests must be made within 1 day after receipt of your goods.</p>
                <p>We accept refund requests for goods sold on our Site for any of the following reasons:</p>
                <ul>
                    <li>Spoiled and molds</li>
                </ul>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Returns</h3>
                <p>Returns can be made in person at the following location: 35 National Road, Brgy. Sta. Rosa, Bayombong, Nueva Vizcaya, 3700.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Consumer Protection Law</h3>
                <p>Where any consumer protection legislation in your jurisdiction applies and cannot be excluded, these Terms and Conditions will not limit your legal rights and remedies under that legislation. These Terms and Conditions will be read subject to the mandatory provisions of the legislation will apply.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Limitation of Liability</h3>
                <p>Mr. Jan Kevin Camacho and our employees, subsidiaries, and affiliates will not be liable for any actions, claims, losses, damages, liabilities, and expenses including legal fees from your use of the Site.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Indemnity</h3>
                <p>Except where prohibited by law, by using this Site you indemnify and hold harmless Mr. Jan Kevin Camacho, our employees, subsidiaries, and affiliates from any actions, claims, losses, damages, liabilities, and expenses including legal fees arising out of your use of our Site or your violation of these Terms and Conditions.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Changes</h3>
                <p>These Terms and Conditions may be amended from time to time in order to maintain compliance with the law and to reflect any changes to the way we operate our Site and the way we expect users to behave on our Site. We will notify users by email of changes to these Terms and Conditions or post a notice on our Site.</p>
                <div class="cws_divider margin-bottom-20"></div>
                <h3>Contact Details</h3>
                <p>Please contact us if you have any questions or concerns. Our contact details are as follows:</p>
                <ul>
                    <li>+6390643033</li>
                    <li>Info@ibake.com</li>
                    <li>35 National Road, Brgy. Sta. Rosa, Bayombong, Nueva Vizcaya, 3700</li><br>
                </ul>
                <p>You can also contact us through the contact form available on our <a href="/contact-us">Site</a>.</p>
            </div>
        </section>
        <!--End Terms and Service Section -->

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
    <script src="js/cart.js?v={{ filemtime(public_path('js/cart.js')) }}"></script>

</body>

</html>
