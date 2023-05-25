$(document).ready(function () {
    // Handle search input changes
    $("#product-search-input").on("input", function () {
        // console.log($("#product-search-input").val());
        loadData();
    });

    // Handle sorting
    $(".sortable").on("click", function () {
        // Remove sorting and indicator classes from all sortable columns
        $(".sortable")
            .not($(this))
            .removeClass("ascending descending current-sort text-white")
            .find(".sort-icon")
            .remove();

        $(this).addClass("current-sort text-white");

        // Toggle the ascending/descending classes
        if ($(this).hasClass("sort-asc")) {
            $(this).removeClass("sort-asc").addClass("sort-desc");
        } else if ($(this).hasClass("sort-desc")) {
            $(this).removeClass("sort-desc").addClass("sort-asc");
        } else {
            // If no class is present, default to ascending
            $(this).addClass("sort-asc");
        }

        // Determine the sort direction based on the current state of the column
        let sortDirection = $(this).hasClass("sort-asc") ? "asc" : "desc";

        $(this).find(".sort-icon").remove();
        let sortIcon =
            sortDirection === "asc" ? "mdi mdi-arrow-up" : "mdi mdi-arrow-down";
        $(this).append(' <i class="sort-icon ' + sortIcon + '"></i>');

        // Load data with the selected sort option
        loadData($(this).data("sort"), sortDirection);
    });

    /* $("#admin-add-product").on("submit", function (e) {
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
                // Handle the response from the server
                $("#form-submit-msg").html(successMsg);
            },
            error: function (xhr, status, err) {
                $("#form-submit-msg").html(failedMsg);
                // Handle error response
                console.log(xhr.responseJSON);
                console.log("status: " + status);
                console.log("error: " + err);
            },
        });
    }); */

    $(".edit-product-btn").on("click", function (e) {
        let productId = $(this).data("productid");
    });

    $(".delete-product-btn").on("click", function () {
        var tableRow = $(this).closest("tr");
        let id = $(this).data("id");
        $.ajax({
            url: "/products/remove/" + id,
            type: "DELETE",
            data: {
                id: id,
                _token: $(this).data("token"),
            },
            success: function (res) {
                // Handle the response from the server
                tableRow.remove();
                $("#product-list-msg").html(res.successMsg);
            },
            error: function (xhr, status, err) {
                // Handle error response
                $("#product-list-msg").html(response.failedMsg);
                console.log(xhr.responseJSON);
                console.log("status: " + status);
                console.log("error: " + err);
            },
        });
    });

    $("#reset-search-btn").on("click", function () {
        // Remove sorting and indicator classes from all sortable columns
        $(".sortable")
            .not($(this))
            .removeClass("ascending descending current-sort text-white")
            .find(".sort-icon")
            .remove();
        $("#product-search-input").val("");
        location.reload();
    });

    $(".product-name").on("click", function () {
        /*         let productName = $(this).html();
        var imgPath = $(this).data("imgpath");

        var relativeImagePath = imgPath.replace(/^.*public[\/\\]/i, "");
        var assetUrl = "{{ asset('" + relativeImagePath + "') }";
        console.log("asset url: " + assetUrl);

        $("#modal-title").html(productName);
        $("#product-image").attr("src", assetUrl);

        console.log(); */
        $("#myInput").trigger("focus");
    });

    /* $("#myModal").on("shown.bs.modal", function () {
        console.log($(this));
        $("#myInput").trigger("focus");
    }); */
});

function loadData(sortBy = "updated_at", sortDirection = "asc") {
    const searchQuery = $("#product-search-input").val();

    $.ajax({
        url: "/products/search",
        method: "GET",
        data: {
            query: searchQuery,
            sortBy: sortBy,
            sortDirection: sortDirection,
        },
        success: function (res) {
            $("#product-table-body").html(res.html);
        },
        error: function (err) {
            console.error(err);
        },
    });
}
