$(document).ready(function () {
    loadCartWidget();

    $("#view-all-shop").on("click", function () {
        $("#min-price").val(0);
        $("#max-price").val(1000);
        $("select[name='sort-order']").val("");
        location.reload();
    });

    $("#filter-shop").on("click", function () {
        let minPrice = $("#min-price").val();
        let maxPrice = $("#max-price").val();
        var sortBy = $("select[name='sort-order']").val();

        loadShopItems(minPrice, maxPrice, sortBy);
    });

    $("select[name='sort-order']").on("change", function () {
        let minPrice = $("#min-price").val();
        let maxPrice = $("#max-price").val();
        let sortBy = $(this).val();

        loadShopItems(minPrice, maxPrice, sortBy);
    });
});

function loadShopItems(minPrice = 0, maxPrice = 1000, sortBy = "updated_at") {
    // Set the sort direction based on the selected value
    var sortOrder = "asc"; // Default to ascending order
    if (sortBy.includes("-desc")) {
        sortBy = sortBy.replace("-desc", "");
        sortOrder = "desc";
    }

    // 'created_at' needs descending order to
    // make the first item/s set to the newly created ones
    if (sortBy === "created_at") {
        sortOrder = "desc";
    }

    $.ajax({
        url: "/shop/filterShop",
        method: "GET",
        data: {
            minPrice: minPrice,
            maxPrice: maxPrice,
            sortBy: sortBy,
            sortOrder: sortOrder,
        },
        success: function (res) {
            $(".product-cards-container").html(res.shopItems);
        },
        error: function (err) {
            console.error(err);
        },
    });
}

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
