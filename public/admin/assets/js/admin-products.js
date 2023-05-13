$(document).ready(function () {
    $("#admin-add-product").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        console.log(formData);
        let successMsg =
            '<div class="alert alert-success" role="alert">Product successfully added!</div>';
        let failedMsg =
            '<div class="alert alert-danger" role="alert">Failed to add Product!</div>';

        $.ajax({
            url: "/products/add",
            type: "POST",
            data: formData,
            success: function (response) {
                console.log(`response\n` + JSON.stringify(response));
                $("#form-submit-msg").html(successMsg);

                // Handle the response from the server
            },
            error: function (xhr, status, error) {
                $(".form-submit-msg").html(failedMsg);
                // Handle error response
                console.log(xhr.responseJSON);
                console.log("status: " + status);
                console.log("error: " + error);
            },
        });
    });
});
