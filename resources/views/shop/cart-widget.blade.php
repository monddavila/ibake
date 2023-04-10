<div class="sidebar-widget cart-widget">
    <div class="widget-content">
        <h3 class="widget-title">Cart</h3>

        <div class="shopping-cart">
            {{-- <h1>{{ $cartWidget }}</h1> --}}
            <ul class="shopping-cart-items">
                @foreach ($cartWidgetProducts as $widgetProduct)
                    <li class="cart-item">
                        <img src="https://via.placeholder.com/300x300" alt="#" class="thumb" />
                        <span class="item-name">{{ $widgetProduct->name }}</span>
                        <span class="item-quantity">1 x <span class="item-amount">Php
                                {{ $widgetProduct->price }}</span></span>
                        <a href="shop-single.html" class="product-detail"></a>
                        <button class="remove-item"><span class="fa fa-times"></span></button>
                    </li>
                @endforeach
            </ul>

            <div class="cart-footer">
                {{-- <div class="shopping-cart-total">There are {{ cartItems->remaining }} items more in the cart.</div> --}}
                <a href="cart.html" class="theme-btn">View Cart</a>
                <a href="checkout.html" class="theme-btn">Checkout</a>
            </div>
        </div>
        <!--end shopping-cart -->
    </div>
</div>
