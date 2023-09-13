$(document).ready(function () {
    $(".order-details-btn").on("click", function () {
        // let productName = $(this).html();
        // var imgPath = $(this).data("imgpath");
        // console.log(productName, imgPath);
        // $.ajax({
        //     url: "/products/getImage",
        //     method: "GET",
        //     data: {
        //         imgPath: imgPath,
        //     },
        //     success: function (res) {
        //         $("#modal-title").html(productName);
        //         $("#product-image").attr("src", res.imgPath);
        //     },
        //     error: function (err) {
        //         console.error(err);
        //     },
        // });
        console.log("asdasdasd");
    });

    $("#myModal").on("shown.bs.modal", function () {
        // $("#myInput").trigger("focus");
    });
});
