<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Review </title>
  @include('partials.head')
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        @include('partials.preloader')

        <!-- Main Header-->
        @include('partials.navbar')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            
            .selected {
                color: gold; /* Selected star color */
            }
        </style>

        <!--End Main Header -->

        <!--Page Title-->
        <section class="page-title" style="background-image: url({{ asset('images/background/background-6.jpg') }})">
        <div class="auto-container">
            <h1>Review</h1>
            <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Customize Cake</a></li>
            <li>Reviews</li>
            </ul>
        </div>
        </section>
        <!--End Page Title-->



        <!--Sidebar Page Container-->
        <div class="page-container">
            <div class="auto-container">
                <div class="row clearfix d-flex justify-content-center" style="padding-bottom: 50px;">
            
                            <!--Product Tabs-->
                            <div class="prod-tabs tabs-box">
            

                                        <!-- Review Form -->
                                        @auth
                                        <div class="comment-form" id="add-review">
                                            <div class="sub-title" style="padding-top: 20px;">
                                            <div class="icon"><img src="{{ asset('images/icons/icon-devider-gray.png') }}" alt=""></div>
                                                <h4>Your feedback is appreciated</h4><br>

                                            <div class="form-outer">
                                                    @if (!session('error') && !session('success') && $reviewExists)

                                                    <div class="alert alert-info alert-dismissible fade show">
                                                    You already have a review for this product, and it will be updated when you submit your changes.
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    </div>
                                                    @elseif(session('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show">
                                                        {{ session('error') }}
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    </div>
                                                    @elseif(session('success'))
                                                    <div class="alert alert-success alert-dismissible fade show">
                                                        {{ session('success') }}
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    </div>
                                                    @endif
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                        <h4>Order ID: {{$id}}</h4>
                                                    </div>
                                                </div>

                                                <div class="rating-box">
                                                    <div class="field-label">Your Rating *</div>
                                                    <div class="rating">
                                                    <span  class="star selected" data-rating="1"><span class="fa fa-star"></span></span>
                                                    <span class="star selected" data-rating="2"><span class="fa fa-star"></span></span>
                                                    <span class="star selected" data-rating="3"><span class="fa fa-star"></span></span>
                                                    <span class="star selected" data-rating="4"><span class="fa fa-star"></span></span>
                                                    <span class="star selected"  data-rating="5"><span class="fa fa-star"></span></span>
                                                    </div>
                                                    
                                                </div>
                                                <form method="POST" action="{{ route('sendCustomReviews') }}">
                                                @csrf
                                                    <div class="row clearfix">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                            <div class="field-label">Your review *</div>
                                                            @if($reviewExists)
                                                            <textarea name="message" value="{{ $review->comment }}"style="height: 100px;" required maxlength="500">{{ $review->comment }}</textarea>
                                                            @else
                                                            <textarea name="message" placeholder="Place your product reviews/comments here" style="height: 100px;" required maxlength="500"></textarea>
                                                            @endif
                                                        </div>

                                                        <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                            <div class="field-label">Name </div>
                                                            <input type="text" name="name" value="{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}" readonly>
                                                        </div>

                                                        <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                                            <div class="field-label">Email </div>
                                                            <input type="email" name="email" value="{{ auth()->user()->email }}" readonly>
                                                        </div>
                                                        
                                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                        <input type="hidden" name="order_id" value="{{ $id }}">
                                                        <input type="hidden" name="rating" id="selected-rating" value="">

                                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                                            @if($reviewExists)
                                                            <input type="submit" name="submit" value="Update">
                                                            @else
                                                            <input type="submit" name="submit" value="Submit">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endauth 
                        
                            </div>
                </div>
            </div>
        </div>
        <!--End Sidebar Page Container-->

        <!-- Main Footer -->
        @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll-to-top')

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
        <script src="{{ asset('js/owl.js') }}"></script>
        <script src="{{ asset('js/wow.js') }}"></script>
        <script src="{{ asset('js/appear.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script src="{{ asset('js/sticky_sidebar.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
            $('.star').on('click', function (e) {
                e.preventDefault(); // Prevent the page from navigating

                var rating = $(this).data('rating');
                $('#selected-rating').val(rating); // Set the value of the hidden input

                // Remove the "selected" class from all stars
                $('.star').removeClass('selected');

                // Add the "selected" class to the clicked star and stars to the left
                $(this).prevAll().addBack().addClass('selected');
            });

            // Handle form submission
            $('form').on('submit', function () {
                // Set the hidden input value one more time before submitting the form
                var rating = $('#selected-rating').val();
                $('#selected-rating').val(rating);
            });
        });

        </script>

        <script>
            window.onload = function () {
                // Check if the URL contains a fragment identifier
                if (window.location.hash) {
                    // Scroll to the element with the matching ID
                    var elementId = window.location.hash.substring(1); // Remove the #
                    var targetElement = document.getElementById(elementId);

                    if (targetElement) {
                        // Scroll to the element
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            };
        </script>



</body>

</html>