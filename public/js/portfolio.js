$(document).ready(function () {
    // Function to load cake images
    function loadCakeImages(start, end) {
        for (let i = start; i <= end; i++) {
            const imageURL = `/images/cakes/cake-${i}.png`;
            const imageHTML = `
                <div class="portfolio-block-four col-lg-2 col-md-4 col-sm-6">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="${imageURL}" alt="Cake ${i}"></figure>
                            <div class="hover-effect">
                                <a href="${imageURL}" class="lightbox-image link" data-fancybox="portfolio"></a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $("#cakes-container").append(imageHTML);
        }
    }

    // Load different numbers of images based on screen width
    function loadImagesBasedOnScreen() {
        if ($(window).width() < 768) {
            // On mobile, load 6 initial images
            loadCakeImages(1, 6);
        } else {
            // On desktop, load 12 initial images
            loadCakeImages(1, 12);
        }
    }

    // Load images when the page loads
    loadImagesBasedOnScreen();

    // Load more images when the "Load More" button is clicked
    $("#load-more").on("click", function (e) {
        e.preventDefault();
        const currentEnd = $(".portfolio-block-four").length;
        const nextEnd = currentEnd + 6;

        // Check if there are more images to load
        if (nextEnd <= totalCakeImages) {
            loadCakeImages(currentEnd + 1, nextEnd);
        } else {
            // Hide the "Load More" button if all images are displayed
            $("#load-more").hide();
        }
    });

    // Total number of cake images in the "cakes" folder
    const totalCakeImages = 42; // Update this number to match the total number of cake images
});
