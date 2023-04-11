<div class="sidebar-widget cart-widget">
    <div class="widget-content">
        <h3 class="widget-title">Cart</h3>

        <div class="shopping-cart">
            <ul class="shopping-cart-items">
                @foreach ($userCartWidget as $widgetItem)
                    <li class="cart-item">
                        <img src="https://via.placeholder.com/300x300" alt="#" class="thumb" />
                        <span class="item-name">{{ $widgetItem->name }}</span>
                        <span class="item-quantity">{{ $widgetItem->quantity }} x <span class="item-amount">Php
                                {{ $widgetItem->price }}</span></span>
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
