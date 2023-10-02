<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Shop Item</title>
  @include('partials.head')
</head>

<body>

  <div class="page-wrapper">

    <!-- Preloader -->
    @include('partials.preloader')

    <!-- Main Header-->
    @include('partials.navbar')
    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image: url({{ asset('images/background/background-6.jpg') }})">
      <div class="auto-container">
        <h1>{{ $product->name }}</h1>
        <ul class="page-breadcrumb">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('shop') }}">Products</a></li>
          <li>{{ $product->name }}</li>
        </ul>
      </div>
    </section>
    <!--End Page Title-->



    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
      <div class="auto-container">
        <div class="row clearfix">

          <!--Content Side-->
          <div class="content-side col-lg-9 col-md-12 col-sm-12">
            <div class="shop-single">
              <!-- Product Detail -->
              <div class="product-details">
                <!--Basic Details-->
                <div class="basic-details">
                  <div class="row clearfix">
                    <div class="image-column col-md-6 col-sm-12">
                      <figure class="image"><a href="{{ asset($product->image) }}" class="lightbox-image"
                          title="Image Caption Here"><img src="{{ asset($product->image) }}" alt=""><span
                            class="icon fa fa-search"></span></a></figure>
                    </div>
                    <div class="info-column col-md-6 col-sm-12">
                      <div class="details-header">
                        <h4>{{ $product->name }}</h4>
                        <strong>{{ number_format($averageRating ?? 0, 2) }}/5</strong> <!-- Value default to zero if Null -->
                        

                        <?php
                        // Stars depending on average product rating from the reviews table
                        $productRating = $averageRating; // actual rating value
                        
                        // Calculate the number of filled and empty stars
                        $filledStars = floor($productRating);
                        $hasHalfStar = ($productRating - $filledStars) >= 0.5;
                        $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0);
                        ?>

                        <!-- Star Rating HTML -->
                        <div class="rating">
                            @for ($i = 1; $i <= $filledStars; $i++)
                                <span class="fa-solid fa-star"></span>
                            @endfor

                            @if ($hasHalfStar)
                                <span class="fa-solid fa-star-half-stroke"></span>
                            @endif

                            @for ($i = 1; $i <= $emptyStars; $i++)
                                <span class="fa-regular fa-star"></span>
                            @endfor
                        </div>


                        <a class="reviews" href="#">({{ $reviewCount }} Customer Reviews)</a>
                        <div class="item-price">Php {{ number_format($product->price, 2) }}</div>
                        {{-- Short item description beside item image --}}
                        <div class="text">{{ $product->item_description }}</div>
                      </div>
                      {{-- {{ dd($product) }} --}}

                      <div class="other-options clearfix">
                        <form id="addToCartForm">
                          @csrf
                          <input type="hidden" name="product_id" value="{{ $product->id }}">
                          <input type="hidden" name="product_name" value="{{ $product->name }}">
                          <input type="hidden" name="product_price" value="{{ $product->price }}">
                          <input type="hidden" name="product_image" value="{{ $product->image }}">
                          <div class="item-quantity">Quantity <input class="quantity" type="number" value="1"
                              name="qty"></div>
                          <div class="cart-msg-container pt-5">
                          </div>
                          <button type="submit" class="theme-btn add-to-cart"><span class="btn-title"
                              data-token="{{ csrf_token() }}">Add To
                              Cart</span></button>
                        </form>


                        <ul class="product-meta">
                          <li class="posted_in">Category: <a href="#">{{ $product->category->name }}</a></li>
                          <li class="posted_in">Tag: <a href="#">
                            @foreach ($tags as $tag)
                              {{ $tag->name }}
                              @unless ($loop->last)
                              ,
                              @endunless
                            @endforeach
                          </a></li>
                          
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!--Basic Details-->

                <!--Product Info Tabs-->
                <div class="product-info-tabs">
                  <!--Product Tabs-->
                  <div class="prod-tabs tabs-box">

                    <!--Tab Btns-->
                    <ul class="tab-btns tab-buttons clearfix">
                      <li data-tab="#prod-details" class="tab-btn">Descripton</li>
                      <li data-tab="#prod-reviews" class="tab-btn active-btn">Review({{ $reviewCount }})</li>
                    </ul>

                    <!--Tabs Container-->
                    <div class="tabs-content">

                      <!--Tab-->
                      <div class="tab" id="prod-details">
                        <h2 class="title">Descripton</h2>
                        <div class="content">
                          {{-- Long item description ner review tab --}}
                          <p>{{ $product->item_description }}</p>
                        </div>
                      </div>

                      <!--Tab-->
                      <div class="tab active-tab" id="prod-reviews">
                        <h2 class="title">Reviews for {{ $product->name }}</h2>
                        <!--Reviews Container-->
                        <div class="comments-area">

                        @if ($reviewCount > 0)
                            <!--Comment Box-->
                            @foreach ($reviews as $review)
                            {{ $review->user->name }}
                            <div class="comment-box">
                              <div class="comment">
                                <div class="author-thumb"><img src="/images/profile/profile-photo.png" alt=""></div>
                                <div class="comment-inner">
                                  <div class="comment-info clearfix">
                                    <strong class="name">{{$review->user->firstname}} 
                                      {{ strtoupper(substr($review->user->lastname, 0, 1)) . '.' }}</strong>
                                      <span class="date">{{ $review->created_at->format('d-M-Y H:i') }}</span>
                                  </div>

                                  <?php
                                    // Stars depending on avearge product rating from the reviews table
                                    $productRating = $review->rating; // actual rating value
                                    
                                    // Calculate the number of filled and empty stars
                                    $filledStars = floor($productRating);
                                    $hasHalfStar = ($productRating - $filledStars) >= 0.5;
                                    $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0);
                                    ?>

                                    <!-- Star Rating HTML -->
                                    <div class="rating">
                                        @for ($i = 1; $i <= $filledStars; $i++)
                                            <span class="fa-solid fa-star"></span>
                                        @endfor

                                        @if ($hasHalfStar)
                                            <span class="fa-solid fa-star-half-stroke"></span>
                                        @endif

                                        @for ($i = 1; $i <= $emptyStars; $i++)
                                            <span class="fa-regular fa-star"></span>
                                        @endfor
                                    </div>


                                  <div class="text">{{ $review->comment }}</div>
                                </div>
                              </div>
                            </div>
                            @endforeach

                              <!-- Pagination Links -->
                              <div class="pagination-wrap">
                                  {{ $reviews->links() }}
                              </div>

                        @else
                        <p>No reviews available for this product.</p>
                        @endif

                        </div>

                        
                      </div>
                    </div>
                  </div>
                </div>
                <!--End Product Info Tabs-->

                <!-- Related Products -->
                <div class="related-products">
                  <div class="sec-title">
                    <h2>Related products</h2>
                  </div>
                  
                  <div class="row clearfix">
                    <!-- Shop Item -->
                    @foreach ($relatedProducts as $product)
                    <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                      <div class="inner-box">
                        <div class="image-box">
                          <figure class="image"><a href="{{ route('item', $product->id) }}"><img src="{{ asset($product->image) }}"
                                alt=""></a>
                          </figure>

                          <div class="btn-box"><a href="{{ route('item', $product->id) }}">Add to
                              cart</a>
                          </div>
                        </div>
                        <div class="lower-content">
                          <h4 class="name"><a href="{{ route('item', $product->id) }}">{{ $product->name }}</a>
                          </h4>

                            @php
                            $productId = $product->id; // Retrieve the product ID
                            $itemRating = $productRatings->where('product_id', $productId)->first();
                            @endphp

                            <?php
                              // Stars depending on average product rating from the reviews table
                              if ($itemRating !== null) {
                                  $productRating = $itemRating->average_rating; // actual rating value

                                  // Calculate the number of filled and empty stars
                                  $filledStars = floor($productRating);
                                  $hasHalfStar = ($productRating - $filledStars) >= 0.5;
                                  $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0);
                              } else {
                                  // Default to zero filled stars if averageRating is null
                                  $filledStars = 0;
                                  $hasHalfStar = false;
                                  $emptyStars = 5;
                              }
                            ?>

                            <!-- Star Rating HTML -->
                            <div class="rating">
                                @for ($i = 1; $i <= $filledStars; $i++)
                                    <span class="fa-solid fa-star"></span>
                                @endfor

                                @if ($hasHalfStar)
                                    <span class="fa-solid fa-star-half-stroke"></span>
                                @endif

                                @for ($i = 1; $i <= $emptyStars; $i++)
                                    <span class="fa-regular fa-star"></span>
                                @endfor
                            </div>

                          <div class="price">Php {{ number_format($product->price, 2) }}</div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    
                  </div>
                </div><!-- End Related Products -->
              </div><!-- Product Detail -->
            </div><!-- End Shop Single -->
          </div>

          <!--Sidebar Side-->
          <div class="sidebar-side sticky-container col-lg-3 col-md-12 col-sm-12">
            <aside class="sidebar theiaStickySidebar">
              <div class="sticky-sidebar">
                <!-- Search Widget -->
                <div class="sidebar-widget search-widget">
                  <form method="post" action="contact.html">
                    <div class="form-group">
                      <input type="search" name="search-field" value="" placeholder="Search products…" required>
                      <button type="submit"><span class="icon fa fa-search"></span></button>
                    </div>
                  </form>
                </div>

                <!-- Cart Widget -->
                <div class='sidebar-widget cart-widget' id="cart-widget-container">
                  <div class="widget-content">
                    <h3 class="widget-title">Cart</h3>
                    <div class="shopping-cart">
                      <h4>No Items in cart.</h4>
                    </div>
                    <!--end shopping-cart -->
                  </div>
                </div>

                <!-- Tags Widget -->
                <div class="sidebar-widget tags-widget">
                  <h3 class="widget-title">Tags</h3>
                  <ul class="tag-list clearfix">
                    @foreach ($tags as $tag)
                    <li><a href="#">{{ $tag->name }}</a></li>
                    @endforeach
                </div>
                
              </div>
            </aside>
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
</body>

</html>