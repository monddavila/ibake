$(document).ready(function () {
    getOrders();
});

function getOrders() {
    $.ajax({
        url: "/dashboard-orders",
        method: "GET",
        dataType: "json",
        success: function (res) {
            // Handle the successful response
            const orders = res.orders;

            //console.log(res.orders);
            orders.forEach(function (orderData) {
                var tableRow = $("<tr>").appendTo("#orders-table tbody");
                $("<td>")
                    .html(
                        '<span class="ps-2">' +
                            orderData.name +
                            "</span>"
                    )
                    .appendTo(tableRow);
                $("<td>").text(orderData.order_id).appendTo(tableRow);
                $("<td>").text(orderData.type).appendTo(tableRow);
                $("<td>").text('₱ ' + orderData.total_price.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }).slice(1)).appendTo(tableRow);
                $("<td>").text(orderData.payment_status).appendTo(tableRow);
                $("<td>").text(orderData.payment_method).appendTo(tableRow);
                $("<td>").text(orderData.order_date).appendTo(tableRow);
                $("<td>").text(orderData.delivery_date).appendTo(tableRow);
                $("<td>")
                    .html(function () {
                        switch (orderData.order_status) {
                            case 'Pending':
                                return '<div class="badge badge-outline-warning">' + orderData.order_status + '</div>';
                            case 'Completed':
                                return '<div class="badge badge-outline-success">' + orderData.order_status + '</div>';
                            case 'Cancelled':
                                return '<div class="badge badge-outline-danger">' + orderData.order_status + '</div>';
                            case 'Processing':
                                return '<div class="badge badge-outline-info">' + orderData.order_status + '</div>';
                            case 'On Delivery':
                                return '<div class="badge badge-outline-primary">' + orderData.order_status + '</div>';
                            default:
                                return '<div class="badge badge-outline-default">' + orderData.order_status + '</div>';
                        }
                    })
                    .appendTo(tableRow);

            });
        },
        error: function (xhr, status, err) {
            // Handle the error
            console.error("AJAX request error:", err);
        },
    });
}
