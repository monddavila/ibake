<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Cart</title>

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
                @if (!$cartItems)
                <tr class="cart-item">
                  <h1>No Items yet</h1>
                </tr>
                @else
                <div class="cart-items">
                  @foreach ($cartItems as $cartItem)
                  <tr class="cart-item">
                    <td class="product-thumbnail"><a href="{{ route('item', $cartItem->product_id) }}"><img
                          src="{{ asset($cartItem->image) }}" alt=""></a>
                    </td>
                    <td class="product-name"><a href="shop-single.html">{{ $cartItem->name }}</a>
                    </td>
                    <td class="product-price">Php {{ number_format($cartItem->price, 2) }}</td>
                    <td class="product-quantity">
                      <div class="quantity"><label>Quantity</label>
                        <input type="number" class="qty" name="quantity" value="{{ $cartItem->quantity }}"
                          data-cartId="{{ $cartItem->cart_id }}" data-productId="{{ $cartItem->product_id }}"
                          data-productPrice="{{ $cartItem->price }}" data-token="{{ csrf_token() }}">
                      </div>
                    </td>
                    <td class="product-subtotal"><span class="amount item-total-price"
                        data-cartId="{{ $cartItem->cart_id }}" data-productId="{{ $cartItem->product_id }}">Php
                        {{ number_format($cartItem->quantity * $cartItem->price, 2) }}</span></td>
                    <td class="product-remove">
                      <form action="{{ route('removeItem', [$cartItem->product_id, $cartItem->cart_id]) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove"><span class="fa fa-times"></span></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </div>
                @endif
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
                <h3>Cart Total</h3>
              </li>
              <li class="clearfix"><span class="col">Subtotal</span><span class="col price">Php
                  {{ number_format($totalPrice, 2) }}</span>
              </li>
              <li class="clearfix"><span class="col">Total</span><span class="col total-price">Php
                  {{ number_format($totalPrice, 2) }}</span>
              </li>
              <li class="text-right"><a href="{{ route('checkout') }}"><button class="theme-btn proceed-btn">Proceed to
                    Checkout</button></a></li>
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
  <script src="js/cart.js"></script>
</body>

</html>