<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Shop Single</title>
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
    <section class="page-title" style="background-image:url(https://via.placeholder.com/1920x400)">
      <div class="auto-container">
        <h1>Birthday Cake</h1>
        <ul class="page-breadcrumb">
          <li><a href="{{ route('home') }}">home</a></li>
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
                        <div class="rating">
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                        </div>
                        <a class="reviews" href="#">(2 Customer Reviews)</a>
                        <div class="item-price">Php {{ $product->price }}</div>
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
                          <li class="posted_in">Category: <a href="#">{{ $product->category }}</a></li>
                          <li class="tagged_as">Tag: <a href="#">Nuts</a></li>
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
                      <li data-tab="#prod-reviews" class="tab-btn active-btn">Review (2)</li>
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
                        <h2 class="title">2 reviews for Birthday Cake</h2>
                        <!--Reviews Container-->
                        <div class="comments-area">
                          <!--Comment Box-->
                          <div class="comment-box">
                            <div class="comment">
                              <div class="author-thumb"><img src="https://via.placeholder.com/60x60" alt=""></div>
                              <div class="comment-inner">
                                <div class="comment-info clearfix">
                                  <strong class="name">Stuart</strong>
                                  <span class="date">– 07 Jun</span>
                                </div>
                                <div class="rating">
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star light"></span>
                                </div>
                                <div class="text">This will go great with my Hoodie
                                  that I ordered a few weeks ago.</div>
                              </div>
                            </div>
                          </div>

                          <!--Comment Box-->
                          <div class="comment-box">
                            <div class="comment">
                              <div class="author-thumb"><img src="https://via.placeholder.com/60x60" alt=""></div>
                              <div class="comment-inner">
                                <div class="comment-info clearfix">
                                  <strong class="name">Maria</strong>
                                  <span class="date">– 07 Jun</span>
                                </div>
                                <div class="rating">
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star"></span>
                                  <span class="fa fa-star light"></span>
                                </div>
                                <div class="text">Love this shirt! The ninja near and
                                  dear to my heart.</div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!--Comment Form-->
                        <div class="comment-form">
                          <div class="sub-title">Add a review</div>
                          <div class="form-outer">
                            <p>Your email address will not be published. Required fields are
                              marked *</p>
                            <div class="rating-box">
                              <div class="field-label">Your Rating</div>
                              <div class="rating">
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                              </div>
                            </div>
                            <form method="post" action="blog-showcase.html">
                              <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                  <div class="field-label">Your review *</div>
                                  <textarea name="message" placeholder=""></textarea>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                  <div class="field-label">Name *</div>
                                  <input type="text" name="username" placeholder="" required="">
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                  <div class="field-label">Email *</div>
                                  <input type="email" name="email" placeholder="" required="">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                  <input type="submit" name="submit" value="Submit">
                                </div>
                              </div>
                            </form>
                          </div>
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
                    <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                      <div class="inner-box">
                        <div class="image-box">
                          <div class="sale-tag">sale!</div>
                          <figure class="image"><a href="shop-single.html"><img
                                src="https://via.placeholder.com/300x300" alt=""></a></figure>
                          <div class="btn-box"><a href="shopping-cart.html">Add to cart</a>
                          </div>
                        </div>
                        <div class="lower-content">
                          <h4 class="name"><a href="shop-single.html">French Macaroon</a>
                          </h4>
                          <div class="rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span
                              class="fa fa-star"></span><span class="fa fa-star"></span><span
                              class="fa fa-star light"></span></div>
                          <div class="price">$17.00</div>
                        </div>
                      </div>
                    </div>

                    <!-- Shop Item -->
                    <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                      <div class="inner-box">
                        <div class="image-box">
                          <figure class="image"><a href="shop-single.html"><img
                                src="https://via.placeholder.com/300x300" alt=""></a></figure>
                          <div class="btn-box"><a href="shopping-cart.html">Add to cart</a>
                          </div>
                        </div>
                        <div class="lower-content">
                          <h4 class="name"><a href="shop-single.html">Happy Ninja</a></h4>
                          <div class="rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span
                              class="fa fa-star"></span><span class="fa fa-star"></span><span
                              class="fa fa-star light"></span></div>
                          <div class="price">$35.00</div>
                        </div>
                      </div>
                    </div>

                    <!-- Shop Item -->
                    <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                      <div class="inner-box">
                        <div class="image-box">
                          <figure class="image"><a href="shop-single.html"><img
                                src="https://via.placeholder.com/300x300" alt=""></a></figure>
                          <div class="btn-box"><a href="shopping-cart.html">Add to cart</a>
                          </div>
                        </div>
                        <div class="lower-content">
                          <h4 class="name"><a href="shop-single.html">Hearts Lollipop</a>
                          </h4>
                          <div class="rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span
                              class="fa fa-star"></span><span class="fa fa-star"></span><span
                              class="fa fa-star light"></span></div>
                          <div class="price">$17.00</div>
                        </div>
                      </div>
                    </div>
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
                    @foreach ($productTags as $productTag)
                    <li><a href="#">{{ $productTag->category }}</a></li>
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