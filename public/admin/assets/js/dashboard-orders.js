$(document).ready(function () {
    console.log("yabai");
    getOrders();
});

function getOrders() {
    /* [
        {
            name: "Estella Bryan",
            code: "02312",
            amount: "$14,500",
            source: "Website",
            payment: "Cash on delivered",
            date1: "04 Dec 2019",
            date2: "04 Dec 2019",
            status: "Pending",
        },
    ]; */
    $.ajax({
        url: "/orders/dashboard",
        method: "GET",
        dataType: "json",
        success: function (res) {
            // Handle the successful response
            const orders = res.orders;

            console.log(res.orders);
            orders.forEach(function (orderData) {
                var tableRow = $("<tr>").appendTo("#orders-table tbody");
                $("<td>")
                    .html(
                        '<div class="form-check form-check-muted m-0"><label class="form-check-label"><input type="checkbox" class="form-check-input"></label></div>'
                    )
                    .appendTo(tableRow);
                $("<td>")
                    .html(
                        '<span class="ps-2">' +
                            orderData.recipient_name +
                            "</span>"
                    )
                    .appendTo(tableRow);
                $("<td>").text(orderData.id).appendTo(tableRow);
                $("<td>").text(orderData.total_price).appendTo(tableRow);
                $("<td>").text("Down Payment").appendTo(tableRow);
                $("<td>").text(orderData.payment_method).appendTo(tableRow);
                $("<td>").text(orderData.order_date).appendTo(tableRow);
                $("<td>").text(orderData.delivery_date).appendTo(tableRow);
                $("<td>")
                    .html(
                        '<div class="badge badge-outline-warning">' +
                            orderData.order_status +
                            "</div>"
                    )
                    .appendTo(tableRow);
            });
        },
        error: function (xhr, status, err) {
            // Handle the error
            console.error("AJAX request error:", err);
        },
    });
}
