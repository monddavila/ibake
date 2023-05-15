$(document).ready(function () {
    $("#admin-add-product").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let successMsg =
            '<div class="alert alert-success" role="alert">Product successfully added!</div>';
        let failedMsg =
            '<div class="alert alert-danger" role="alert">Failed to add Product!</div>';

        $.ajax({
            url: "/products/add",
            type: "POST",
            data: formData,
            success: function (res) {
                console.log(`response\n` + JSON.stringify(res));
                $("#form-submit-msg").html(successMsg);

                // Handle the response from the server
            },
            error: function (xhr, status, error) {
                $("#form-submit-msg").html(failedMsg);
                // Handle error response
                console.log(xhr.responseJSON);
                console.log("status: " + status);
                console.log("error: " + error);
            },
        });
    });

    $(".edit-product-btn").on("click", function (e) {
        console.log(e);
        let productId = $(this).data("productid");
        console.log("edit product id: " + productId);
    });

    $(".delete-product-btn").on("click", function () {
        var tableRow = $(this).closest("tr");
        let id = $(this).data("id");
        console.log("deleted");
        $.ajax({
            url: "/products/remove/" + id,
            type: "DELETE",
            data: {
                id: id,
                _token: $(this).data("token"),
            },
            success: function (res) {
                tableRow.remove();
                $("#product-list-msg").html(res.successMsg);
            },
            error: function (xhr, status, error) {
                // Handle error response
                $("#product-list-msg").html(response.failedMsg);
                console.log(xhr.responseJSON);
                console.log("status: " + status);
                console.log("error: " + error);
            },
        });
    });

    $("#product-search-btn").click(function () {
        var searchInput = $("#product-search-input").val();

        $.ajax({
            url: "/products/search",
            type: "GET",
            data: {
                searchInput: searchInput,
                _token: $(this).data("token"),
            },
            success: function (res) {
                // Handle the data returned from the server
                $("#product-table-body").html(res.html);
                console.log(res.html);
            },
            error: function (xhr, status, error) {
                // Handle error response
                // $("#product-list-msg").html(response.failedMsg);
                console.log(xhr.responseJSON);
                console.log("status: " + status);
                console.log("error: " + error);
            },
        });
    });
});
