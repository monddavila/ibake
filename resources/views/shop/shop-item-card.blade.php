@foreach ($products as $product)
<div class="shop-item col-lg-4 col-md-6 col-sm-12">
  <div class="inner-box">
    <div class="image-box">
      <figure class="image"><a href="{{ route('item', $product->id) }}"><img src="{{ asset($product->image) }}" alt=""></a></figure>
      <div class="btn-box"><a href="{{ route('item', $product->id) }}">Add to cart</a></div>
    </div>
    <div class="lower-content">
      <h4 class="name"><a href="{{ route('item', $product->id) }}">{{ $product->name }}</a></h4>

      @php
      $productId = $product->id; // Retrieve the product ID
      $averageRating = $averageRatings->where('product_id', $productId)->first();
      @endphp

      <?php
      // Check if averageRating is not null
      if ($averageRating) {
          // Stars depending on average product rating from the reviews
          $productRating = $averageRating->average_rating; // actual rating value

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
