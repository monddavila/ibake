$(document).ready(function () {
    loadCartWidget();

    $("#addToCartForm").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        console.log(formData);
        let successMsg =
            '<div class="alert alert-success" role="alert">Item successfully added to cart!</div>';
        let failedMsg =
            '<div class="alert alert-danger" role="alert">Failed to add item to cart!</div>';

        $.ajax({
            url: "/cart/add-to-cart",
            type: "POST",
            data: formData,
            success: function (response) {
                loadCartWidget();
                $(".cart-msg-container").html(successMsg);

                // Handle the response from the server
            },
            error: function (xhr, status, error) {
                $(".cart-msg-container").html(failedMsg);
                // Handle error response
                console.log(xhr.responseJSON);
                console.log("status: " + status);
                console.log("error: " + error);
            },
        });
    });

    $(".qty").on("input", function () {
        updateQuantity($(this));
    });
});

function loadCartWidget() {
    $.ajax({
        url: "/cart/userCartWidget",
        method: "GET",
        success: function (res) {
            $(".shopping-cart").html(res.cartWidget);
        },
        error: function (err) {
            console.error(err);
        },
    });
}

/**
 *  For updating the quantity of an itme
 * in the user cart page.
 * Updates the item quantity and
 * total item price
 *
 */
function updateQuantity(item) {
    // Get cart item information
    let quantity = $(item).val();

    if (quantity < 0) {
        $(item).val(0);
        return;
    }
    let productId = $(item).data("productid");
    let cartId = $(item).data("cartid");
    let productPrice = $(item).data("productprice");
    let token = $(item).data("token");
    let total = quantity * productPrice;

    let totalPrice = 0;

    // Update cart item quantity
    $.ajax({
        url: "/cart/update-cart-quantity",
        type: "PUT",
        data: {
            quantity: quantity,
            productId: productId,
            cartId: cartId,
            _token: token,
        },
        success: function (res) {
            $(
                'span.item-total-price[data-cartId="' +
                    cartId +
                    '"][data-productId="' +
                    productId +
                    '"]'
            ).text("Php " + total);
            $("span.amount").each(function () {
                let amount = parseInt($(this).text().replace("Php", "").trim());
                totalPrice += amount;
            });
            $("span.col.price").text("Php " + totalPrice);
            $("span.col.total-price").text("Php " + totalPrice);
        },
        error: function (xhr) {
            // Handle error response
            console.log(`error\n` + xhr);
        },
    });
}
