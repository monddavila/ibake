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
        <section class="page-title" style="background-image:url(images/background/background-6.jpg">
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
                    <h2>Track your order and stay informed</h2>
                    <div class="text">
                        Enter your Order ID in the search bar below to track the status of your order. Once you click the "Track" button, you will be able to see the scheduled delivery date and time of your order. Tracking your order helps you stay up-to-date on its status and receive notifications if there are any delays or changes. If you have any questions, please feel free to contact us.
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Track Your Order</div>
                            <div class="panel-body">
                                <form method="post" action="{{ route('trackOrderId') }}">
                                    @csrf <!-- Laravel CSRF protection -->

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" name="order_id" class="form-control" placeholder="Enter Order ID Number" required>
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-search"></i> Track
                                                </button>
                                            </span>
                                        </div>
                                        @if(isset($error) && $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                        @endif
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if (isset($orderDetails) && $orderDetails->isNotEmpty())
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="container mt-6">
                                <div class="row">
                                </div>

                                <div>
                                    <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
                                    <h5 class="size-label font-weight-bold text-left">Order Tracking Result</h5>
                                    <hr>
                                    
                                    @foreach ($orderDetails as $order)
                                        <p>Order ID: {{ $order->order_id }}</p>
                                        <p>Order Status: <span class="size-label font-weight-bold text-left">{{ $order->order_status }}</span></p>
                                        <p>Scheduled Delivery Date: {{ $order->delivery_date }}</p>
                                        <p>Scheduled Delivery Time: {{ $order->delivery_time }}</p>
                                        <p>Shipping Method: {{ $order->shipping_method }}</p>
                                        <p>Recipient Name: {{ $order->recipient_name }}</p>
                                        <br>
                                        <hr>
                                    @endforeach
                                    <p>Visit your account <a href="{{ route('customer') }}">dashboard</a> to see more details.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (isset($customizeOrderDetails) && $customizeOrderDetails->isNotEmpty())
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="container mt-6">
                                <div class="row">
                                </div>

                                <div>
                                    <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
                                    <h5 class="size-label font-weight-bold text-left">Order Tracking Result</h5>
                                    <hr>
                                    
                                    @foreach ($customizeOrderDetails as $order)
                                        <p>Order ID: {{ $order->customizeOrder->orderID }}</p>
                                        <p>Order Status: <span class="size-label font-weight-bold text-left">{{ $order->order_status }}</span></p>
                                        <p>Scheduled Delivery Date: {{ $order->delivery_date }}</p>
                                        <p>Scheduled Delivery Time: {{ $order->delivery_time }}</p>
                                        <p>Shipping Method: {{ $order->shipping_method }}</p>
                                        <p>Recipient Name: {{ $order->recipient_name }}</p>
                                        <br>
                                        <hr>
                                    @endforeach
                                    <p>Visit your account <a href="{{ route('customer') }}">dashboard</a> to see more details.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

    </div>
    </section>
    <!--End Contact Section -->


    <!-- Footer Section -->
    @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll-to-top')


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