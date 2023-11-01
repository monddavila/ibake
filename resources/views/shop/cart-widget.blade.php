@if (count($userCart) > 0)
    <ul class="shopping-cart-items">
            @php
            $subtotal = 0; // Initialize the subtotal
            @endphp


          @foreach ($userCart as $cartItem)
          <li class="cart-item">
            <img src="{{ asset($cartItem->image) }}" alt="#" class="thumb" />
            <span class="item-name">{{ $cartItem->name }}</span>
            <span class="item-quantity">{{ $cartItem->quantity }} x <span class="item-amount">Php
                {{ number_format($cartItem->price, 2) }}</span></span>
            @if (Auth::check())
            <a href="{{ route('item', $cartItem->product_id) }}" class="product-detail"></a>
            @else
            <a href="{{ route('showCart') }}" class="product-detail"></a>
            @endif
            
            <button class="remove-item"><span class="fa fa-times"></span></button>
          </li>

              @php
              $itemTotal = $cartItem->quantity * $cartItem->price; // Calculate the total for this item
              $subtotal += $itemTotal; // Add it to the subtotal
              @endphp

              @endforeach
          </ul>

        <!-- Cart Footer -->
        <div class="cart-footer">
          @if ($cartItemCount > 3)
          <div class="shopping-cart-total">There are {{ $cartItemCount - 3 }} item(s) more in the cart.</div>
          @endif

          <!-- Display the Subtotal -->
          @if ($cartItemCount > 0)
          <div class="shopping-cart-total"><strong>Subtotal:</strong> Php {{ number_format($subtotal, 2) }}</div>
          @endif

          <a href="{{ url('/cart') }}" class="theme-btn">View Cart</a>
          <a href="{{ route('checkout') }}" class="theme-btn">Checkout</a>
        </div>

@else
                                <ul class="shopping-cart-items">
                                    <li class="cart-item">
                                    </li>

                                </ul>

                                <div class="cart-footer">
                                    <div class="shopping-cart-total">Your cart is currently empty</div>
                                    <a href="{{ route('shop') }}" class="theme-btn">View Shop</a>
                                    <a href="{{ route('customize') }}" class="theme-btn">Customize</a>
                                </div>
                       
@endif

