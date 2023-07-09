<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Checkout</title>

  <!-- Stylesheets -->
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
    <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
      <div class="auto-container">
        <h1>Checkout</h1>
        <ul class="page-breadcrumb">
          <li><a href="/">home</a></li>
          <li>Checkout</li>
        </ul>
      </div>
    </section>
    <!--End Page Title-->

    <!--CheckOut Page-->
    <section class="checkout-page">
      <div class="auto-container">
        <!--Default Links-->
        {{-- <div class="default-links">
          <div class="message-box with-icon info">
            <div class="icon-box"><span class="icon fa fa-info"></span></div> Have a coupon? <a href="#">Click here to
              enter your code</a>
          </div>
        </div> --}}

        <!--Checkout Details-->
        <div class="checkout-form-container">
          <div class="sec-title">
            <h3>Checkout details</h3>
          </div>
          <form method="POST" action="{{ route('createOrder') }}" class="checkout-form">
            @CSRF
            <div class="row clearfix">
              <!--Column-->
              <div class="column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Recipient's Name <sup>*</sup></div>
                    <input type="text" name="recipient_name" value="{{ $user->firstname . ' ' . $user->lastname }}"
                      placeholder="">
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Delivery address <sup>*</sup></div>
                    <input type="text" name="street_address" value="" placeholder="Building Name/Street">
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Town / City <sup>*</sup></div>
                    <input type="text" name="town" value="" placeholder="">
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Province <sup>*</sup></div>
                    <input type="text" name="province" value="" placeholder="">
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Postcode/ ZIP <sup>*</sup></div>
                    <input type="text" name="postcode" value="" placeholder="">
                  </div>
                </div>
              </div>

              <!--Column-->
              <div class="column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Email Address <sup>*</sup></div>
                    <input type="text" name="recipient_email" value="{{ $user->email }}" placeholder="">
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Phone Number <sup>*</sup></div>
                    <input type="text" name="recipient_phone" value="{{ $user->phone }}" placeholder="">
                  </div>

                  <!--Form Group-->
                  <div class="form-group ">
                    <div class="field-label">Delivery Date <sup>*</sup></div>
                    <input type="date" id="delivery-date" name="delivery_date">
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Delivery Time <sup>*</sup></div>
                    <input type="time" id="delivery-time" name="delivery_time" value="09:30">
                  </div>

                  <!--Form Group-->
                  <div class="form-group ">
                    <div class="field-label">Order notes (optional)</div>
                    <textarea class="" name="order_notes"
                      placeholder="Notes about your order,e.g. special notes for delivery."></textarea>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!--End Checkout Details-->

        <!--Order Box-->
        <div class="order-box">
          <table>
            <thead>
              <tr>
                <th class="product-name">Product</th>
                <th class="product-total">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($cartItems as $cartItem)
              <tr class="cart-item">
                <td class="product-name">{{ $cartItem->name }}&nbsp;
                  <strong class="product-quantity">× {{ $cartItem->quantity }}</strong>
                </td>
                <td class="product-total">
                  <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Php
                    </span>{{ $cartItem->price * $cartItem->quantity }}</span>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              {{-- <tr class="cart-subtotal">
                <th>Subtotal</th>
                <td><span class="amount">Php {{ $totalPrice }}</span></td>
              </tr> --}}
              <tr class="order-total">
                <th>Total</th>
                <td><strong class="amount">Php {{ $totalPrice }}</strong> </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!--End Order Box-->

        <!--Payment Box-->
        <div class="payment-box">
          <div class="upper-box">
            <!--Payment Options-->
            <div class="payment-options">
              <ul>
                <li>
                  <div class="radio-option">
                    <input type="radio" name="payment_method" id="payment-2" value="Bank Transfer" checked>
                    <label for="payment-2"><strong>Direct Bank Transfer</strong><span class="small-text">Make your
                        payment directly into our bank account. Please use your Order ID as the payment reference. Your
                        order won’t be shipped until the funds have cleared in our account.</span></label>
                  </div>
                </li>
                <li>
                  <div class="radio-option">
                    <input type="radio" name="payment_method" id="payment-1" value="Check Payment">
                    <label for="payment-1"><strong>Check Payments</strong><span class="small-text">Make your payment
                        directly into our bank account. Please use your Order ID as the payment reference. Your order
                        won’t be shipped until the funds have cleared in our account.</span></label>
                  </div>
                </li>

                <li>
                  <div class="radio-option">
                    <input type="radio" name="payment_method" id="payment-3" value="Cash on Delivery">
                    <label for="payment-3"><strong>Cash on Delivery</strong><span class="small-text">Make your payment
                        directly into our bank account. Please use your Order ID as the payment reference. Your order
                        won’t be shipped until the funds have cleared in our account.</span></label>
                  </div>
                </li>
              </ul>
              <div class="text">Your personal data will be used to process your order, support your experience
                throughout this website, and for other purposes described in our <a href="#">privacy policy.</a></div>
            </div>
          </div>
          <div class="lower-box">
            <button type="submit" class="theme-btn" id="checkout-btn"><span class="btn-title">Place
                Order</span></button>
          </div>
        </div>
        </form>
        <!--End Payment Box-->
      </div>
    </section>
    <!--End CheckOut Page-->

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
  <script src="{{ asset('js/checkout.js') }}"></script>
</body>

</html>