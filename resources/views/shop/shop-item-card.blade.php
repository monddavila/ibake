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
      <h4 class="name"><a href="shop-single.html">{{ $product->name }}</a>
      </h4>
      <div class="rating"><span class="fa fa-star"></span><span class="fa fa-star"></span><span
          class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star light"></span>
      </div>
      <div class="price">Php {{ $product->price }}</div>
    </div>
  </div>
</div>
@endforeach