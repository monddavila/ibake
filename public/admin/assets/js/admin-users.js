$(document).ready(function () {
    // Handle search input changes
    $("#user-search-input").on("input", function () {
        // console.log($("#user-search-input").val());
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

    $("#reset-search-btn").on("click", function () {
        // Remove sorting and indicator classes from all sortable columns
        $(".sortable")
            .not($(this))
            .removeClass("ascending descending current-sort text-white")
            .find(".sort-icon")
            .remove();
        $("#user-search-input").val("");
        location.reload();
    });
});

function loadData(sortBy = "updated_at", sortDirection = "asc") {
    const searchQuery = $("#user-search-input").val();
    console.log(searchQuery);
    $.ajax({
        url: "/user/search",
        method: "GET",
        data: {
            query: searchQuery,
            sortBy: sortBy,
            sortDirection: sortDirection,
        },
        success: function (res) {
            $("#users-table-body").html(res.html);
        },
        error: function (err) {
            console.error(err);
        },
    });
}
