@foreach ($products as $product)
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


        <?php
        // Stars depending on product rating from the database
        $productRating = $product->rating; // actual rating value

        // Calculate the number of filled and empty stars
        $filledStars = floor($productRating);
        $hasHalfStar = ($productRating - $filledStars) >= 0.5;
        ?>

        <!-- Star Rating HTML -->
        <div class="rating">
            <?php
            // Render filled stars
            for ($i = 1; $i <= $filledStars; $i++) {
                echo '<span class="fa fa-star"></span>';
            }

            // Render a half star if needed
            if ($hasHalfStar) {
                echo '<span class="fa fa-star-half"></span>';
                $filledStars++; // Increment the count of filled stars
            }

            // Render empty stars
            for ($i = $filledStars + 1; $i <= 5; $i++) {
                echo '<span class="fa fa-star-o"></span>';
            }
            ?>
        </div>



      <div class="price">Php {{ $product->price }}</div>
    </div>
  </div>
</div>
@endforeach