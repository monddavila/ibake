$(document).ready(function () {
    // Handle search input changes
    $("#product-search-input").on("input", function () {
        // Remove sorting
        $(".sortable")
            .removeClass("ascending descending current-sort text-white")
            .find(".sort-icon")
            .remove();

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
        let productName = $(this).html();
        var imgPath = $(this).data("imgpath");
        $.ajax({
            url: "/products/getImage",
            method: "GET",
            data: {
                imgPath: imgPath,
            },
            success: function (res) {
                $("#modal-title").html(productName);
                $("#product-image").attr("src", res.imgPath);
            },
            error: function (err) {
                console.error(err);
            },
        });
    });
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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#product-img-tag").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // If no file is selected, set the image source to a blank image
        $("#product-img-tag").attr("src", "");
    }
}

$("#product-img-upload").change(function () {
    readURL(this);
});