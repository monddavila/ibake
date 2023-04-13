<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bellaria - a Delicious Cakes and Bakery HTML Template | Shopping Cart</title>

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
                <h1>Cart</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('home') }}">home</a></li>
                    <li>Cart</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

        <!--Cart Section-->
        <section class="cart-section">
            <div class="auto-container">
                <!--Cart Outer-->
                <div class="cart-outer">
                    <div class="table-outer">
                        <table class="cart-table">
                            <thead class="cart-header">
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $cartItem)
                                    <tr class="cart-item">
                                        <td class="product-thumbnail"><a href="shop-single.html"><img
                                                    src="https://via.placeholder.com/300x300" alt=""></a></td>
                                        <td class="product-name"><a href="shop-single.html">{{ $cartItem->name }}</a>
                                        </td>
                                        <td class="product-price">Php {{ $cartItem->price }}</td>
                                        <td class="product-quantity">
                                            <div class="quantity"><label>Quantity</label><input type="number"
                                                    class="qty" name="quantityty" value="{{ $cartItem->quantity }}">
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount">Php
                                                {{ $cartItem->quantity * $cartItem->price }}</span></td>
                                        <td class="product-remove">
                                            <form
                                                action="{{ route('removeItem', [$cartItem->product_id, $cartItem->cart_id]) }}"
                                                method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="remove"><span
                                                        class="fa fa-times"></span></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-options clearfix">
                        <div class="pull-left">
                            <div class="apply-coupon clearfix">
                                <div class="form-group clearfix">
                                    <input type="text" name="coupon-code" value="" placeholder="Coupon Code">
                                </div>
                                <div class="form-group clearfix">
                                    <button type="button" class="theme-btn coupon-btn">Apply Coupon</button>
                                </div>
                            </div>
                        </div>

                        <div class="pull-right">
                            <button type="button" class="theme-btn cart-btn">update cart</button>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="column col-lg-4 offset-lg-8 col-md-6 col-sm-12">
                        <!--Totals Table-->
                        <ul class="totals-table">
                            <li>
                                <h3>Cart Totals</h3>
                            </li>
                            <li class="clearfix"><span class="col">Subtotal</span><span
                                    class="col price">$186.00</span></li>
                            <li class="clearfix"><span class="col">Total</span><span
                                    class="col total-price">$186.00</span></li>
                            <li class="text-right"><button type="submit" class="theme-btn proceed-btn">Proceed to
                                    Checkout</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--End Cart Section-->

        <!-- Main Footer -->
        @include('partials.footer')
        <!-- End Footer -->

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
    <script src="js/select2.min.js"></script>
    <script src="js/sticky_sidebar.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
