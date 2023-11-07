<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Checkout</title>

  <!-- Stylesheets -->
  @include('partials.head')

  <style>
  .btn-group-toggle .btn {
    flex: 1;
    text-align: center;
    background-color: #5fcac7  !important;
    color: white !important;
  }

  .btn-group-toggle .btn.active {
    background-color: #ff91a4 !important;
    color: black !important;
  }
</style>

</head>

<body>

  <div class="page-wrapper">

    <!-- Preloader -->
    @include('partials.preloader')

    <!-- Main Header-->
    @include('partials.navbar')
    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url('{{ asset('images/background/background-6.jpg') }}')">
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
        <div class="default-links">
          <div class="message-box with-icon warning">
            <div class="icon-box"><span class="icon fa fa-warning"></span></div> Thank you for choosing iBake! Please note that we only deliver to all areas within Nueva Vizcaya.
             <br>You can also pick up your order at our <a href="{{ route('faqs') }}" target="_blank">shop</a>. 
             <button class="close-btn"><span class="fa fa-times"></span></button>
          </div>
        </div>

        <!--Checkout Details-->
        <div class="checkout-form-container">
          <div class="sec-title">
            <h3>Checkout details</h3>
          </div>
       
          <form method="POST" action="{{ route('placeCustomOrderBalance', ['id' => $customOrderId]) }}" class="checkout-form">
            @CSRF

            <input type="hidden" name="balance_check_token" value="{{ $token }}">

            <div class="row clearfix">
              <!--Column-->
              <div class="column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Recipient's Name</div>
                    <input type="text" name="recipient_name" value="{{ $orders->first()->customizeOrderDetail->recipient_name }}" readonly>
                  </div>

                   <!--Form Group-->
                   <div class="form-group">
                    <div class="field-label">Email Address</div>
                    <input type="text" name="recipient_email" value="{{ $orders->first()->customizeOrderDetail->recipient_email }}" readonly>
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Phone Number</div>
                    <input type="text" name="recipient_phone" value="+63{{ $orders->first()->customizeOrderDetail->recipient_phone }}" readonly>
                                        @error('recipient_phone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  @if($orders->first()->customizeOrderDetail->shipping_method == 'Delivery')
                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Delivery address</div>
                    <textarea name="street_address" readonly>{{ str_replace('||', ', ', $orders->first()->customizeOrderDetail->delivery_address) }}</textarea>
                  </div>
                  @endif


                 

                  
                </div>
              </div>

              <!--Column-->
              <div class="column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                  
                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Shipping Option</div>
                    <input type="text" name="shipping_method" value="{{ $orders->first()->customizeOrderDetail->shipping_method }}" readonly>
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                   @if($orders->first()->customizeOrderDetail->shipping_method == 'Delivery')
                    <div class="field-label">Delivery Date</div>
                    @else
                    <div class="field-label">Pick-up Date</div>
                    @endif

                    <input type="text" name="delivery_date" value="{{ date('d-F-Y', strtotime($orders->first()->customizeOrderDetail->delivery_date)) }}" readonly>
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    @if($orders->first()->customizeOrderDetail->shipping_method == 'Delivery')
                    <div class="field-label">Delivery Time</div>
                    @else
                    <div class="field-label">Pick-up Time</div>
                    @endif
                    <input type="text" name="delivery_time" value="{{ date('g:i A', strtotime($orders->first()->customizeOrderDetail->delivery_time)) }}" readonly>
                  </div>

                  <!--Form Group-->
                <div class="form-group">
                    <div class="field-label">Order Notes</div>
                    <textarea name="notes" readonly>{{ $orders->first()->customizeOrderDetail->notes }}</textarea>
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
                    <th class="product-total">Payment Balance</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $order)
                  <tr class="cart-item">
                  <td class="product-img">
                      @if(empty($order->cakeOrderImage))
                          <img src="{{ asset('images/resource/custom-cake-order.png') }}" alt="" style="width: 80px; height: 80px;">
                      @else
                          <img src="{{ asset($order->cakeOrderImage) }}" alt="" style="width: 80px; height: 80px;">
                      @endif
                      &nbsp;&nbsp;Customized Cake Request&nbsp;
                      <strong class="product-quantity">× 1</strong>
                  </td>

                    <td class="product-total">
                      <span class="woocommerce-Price-amount amount"><span
                          class="woocommerce-Price-currencySymbol">Php</span>{{ number_format($orders->first()->customizeOrderDetail->payment_balance * 1, 2) }}</span>
                    </td>

                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  {{-- <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td><span class="amount">Php {{ number_format($orders->first()->customizeOrderDetail->payment_balance, 2) }}</span></td>
                  </tr> --}}
                  <tr class="order-total">
                    <th><strong>Total Balance</strong></th>
                    <td><strong class="amount">Php {{ number_format($orders->first()->customizeOrderDetail->payment_balance, 2) }}</strong> </td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!--End Order Box-->

            <!--Payment Box-->
            <div class="payment-box">
              <div class="upper-box">

              


                <!--Payment Type Box End-->

                <!--Payment Options-->
                <div class="payment-options">
                    <div class="text">The shipping fee is not included in the total price. 
                      You will pay the shipping fee when you receive your order. For more information, please see our <a href="{{route('terms')}}" target="_blank">Terms & Services.</a></div><br>
                  <ul>

                    <li>
                      <div class="radio-option">
                        <input type="radio" name="payment_method" id="payment-1" value="wallet" checked>
                        <label for="payment-2"><strong>Digital Wallets</strong><span class="small-text">
                        Pay with your favorite digital wallet, such as GCash and Maya. Please use your Order ID as the payment reference. 
                        Your order won’t be shipped until the funds have cleared in our account.</span></label>
                      </div>
                    </li>
                    
                    <li>
                      <div class="radio-option">
                        <input type="radio" name="payment_method" id="payment-2" value="card">
                        <label for="payment-1"><strong>Credit Or Debit Card</strong><span class="small-text">
                        We accept Visa and Mastercard debit and credit cards, make your payment directly using your card details. 
                        Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</span></label>
                      </div>
                    </li>

                    <li>
                      <div class="radio-option">
                        <input type="radio" name="payment_method" id="payment-3" value="bank">
                        <label for="payment-3"><strong>Online Banking</strong><span class="small-text">
                        Make your payment directly using your online banking account. Please use your Order ID as the payment reference. 
                        Your order won’t be shipped until the funds have cleared in our account.</span></label>
                      </div>
                    </li>

                  </ul>
                  <div class="text">Your personal data will be used to process your order, support your experience
                    throughout this website, and for other purposes described in our <a href="{{ route('privacy') }}" target="_blank">Privacy policy.</a></div>
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
      </div>
    </section>
    <!--End CheckOut Page-->

    <!-- Main Footer -->
    @include('partials.footer')
    <!-- End Footer -->

  </div><!-- End Page Wrapper -->

  <!-- Scroll To Top -->
  @include('partials.scroll-to-top')

  <!-- Date of Delivery Validation (2 Days from today) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deliveryDateInput = document.getElementById("delivery-date");

      // Get today's date and add two days
      const minDate = new Date();
      minDate.setDate(minDate.getDate() + 2);

      // Format the minimum date as YYYY-MM-DD for input validation
      const minDateString = minDate.toISOString().split("T")[0];

      // Set the minimum attribute of the input field
      deliveryDateInput.min = minDateString;

      // Add an event listener to check the selected date on change
      deliveryDateInput.addEventListener("change", function() {
        const selectedDate = new Date(this.value);

        if (selectedDate < minDate) {
          alert("Delivery/Pickup date should be at least two days from today.");
          this.value = ""; // Clear the input value
        }
      });
    });
  </script>

  <!-- Time of Delivery Validation (8 am to 5:30 pm) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deliveryTimeInput = document.getElementById("delivery-time");

      // Set the range for valid delivery times (8 AM to 6 PM)
      const validStartTime = new Date();
      validStartTime.setHours(8, 0, 0, 0); // 8:00 AM

      const validEndTime = new Date();
      validEndTime.setHours(17, 30, 0, 0); // 5:30 PM

      // Add an event listener to check the selected time on change
      deliveryTimeInput.addEventListener("change", function() {
        const selectedTimeParts = this.value.split(":");
        const selectedTime = new Date();
        selectedTime.setHours(parseInt(selectedTimeParts[0]), parseInt(selectedTimeParts[1]), 0, 0);

        if (selectedTime < validStartTime || selectedTime > validEndTime) {
          alert("Delivery/Pickup time should be between 8:00 AM and 5:30 PM.");
          this.value = "08:30"; // Reset the time to the default value
        }
      });
    });
  </script>

    <!-- JavaScript to display prompt message when delivery is ticked -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deliveryRadio = document.getElementById("shipping-2");
      deliveryRadio.addEventListener("change", function() {
        if (this.checked) {
          // Display the prompt message
          alert("Please note that the shipping fee is not yet included in the total price. It will be added to your total due when you receive your order.");
        }
      });
    });
  </script>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/owl.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/appear.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
  <script src="{{ asset('js/checkout.js') }}"></script>

  
</body>

</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    