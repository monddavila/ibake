<div class="sidebar-widget cart-widget">
    <div class="widget-content">
        <h3 class="widget-title">Cart</h3>

        <div class="shopping-cart">
            <ul class="shopping-cart-items">

                @foreach ($userCart as $cartItem)
                    <pre>{{ $cartItem->price }}</pre>
                    <li class="cart-item">
                        <img src="https://via.placeholder.com/300x300" alt="#" class="thumb" />
                        <span class="item-name">{{ $cartItem->name }}</span>
                        <span class="item-quantity">{{ $cartItem->quantity }} x <span class="item-amount">Php
                                {{ $cartItem->price }}</span></span>
                        <a href="shop-single.html" class="product-detail"></a>
                        <button class="remove-item"><span class="fa fa-times"></span></button>
                    </li>
                @endforeach
                {{-- @foreach ($userCart as $cartItem)
                    <li class="cart-item">
                        <h1>nice</h1>

                        <img src="https://via.placeholder.com/300x300" alt="#" class="thumb" />
                        <span class="item-name">{{ $cartItem->name }}</span>
                        <span class="item-quantity">{{ $cartItem->quantity }} x <span class="item-amount">Php
                                {{ $cartItem->price }}</span></span>
                        <a href="shop-single.html" class="product-detail"></a>
                        <button class="remove-item"><span class="fa fa-times"></span></button>
                    </li>
                @endforeachf --}}
            </ul>

            <div class="cart-footer">
                <div class="shopping-cart-total">There are {{-- {{ count($userCart) }} --}} items more in the cart.
                </div>
                <a href="{{ url('/cart') }}" class="theme-btn">View Cart</a>
                <a href="checkout.html" class="theme-btn">Checkout</a>
            </div>
        </div>
        <!--end shopping-cart -->
    </div>
</div>
