(function ($) {
    "use strict";
    $(function () {
        // When the "file-upload-browse" button is clicked
        $(".file-upload-browse").on("click", function () {
            // Find the associated file input element
            var file = $(this)
                .parent()
                .parent()
                .parent()
                .find(".file-upload-default");
            
            // Trigger a click event on the file input element
            file.trigger("click");
        });

        // When the file input element changes (a file is selected)
        $(".file-upload-default").on("change", function () {
            // Get the selected file's name and display it in the form control
            $(this)
                .parent()
                .find(".form-control")
                .val(
                    $(this)
                        .val()
                        // Remove the "C:\fakepath\" prefix that some browsers add
                        .replace(/C:\\fakepath\\/i, "")
                );
        });
    });
})(jQuery);
