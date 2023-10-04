@foreach ($products as $product)
<tr id="product-{{ $product->id }}">
  <td>{{ $product->id }}</td>
  <td><img src="{{ asset($product->image) }}" class="product-name" alt="Product Image" data-toggle="modal" data-target="#productImageModal" data-imgPath="{{ $product->image }}"></td>
  <td class="product-name" data-toggle="modal" data-target="#productImageModal" data-imgPath="{{ $product->image }}">{{
    $product->name }}</td>
  <td>{{ $product->price }}</td>
  <td>{{ $product->category_name }}</td>
  <td>{{ $product->rating }}</td>
  <td>{{ $product->isfeatured ? 'Yes' : 'No' }}</td>
  <td>{{ $product->availability ? 'Available' : 'Unavailable' }}</td>
  {{-- <td><a href="#"><i class="mdi mdi-image-area product-img"></i></a></td> --}}
  <td>
    <a href="{{ route('admin.viewEditProducts', $product->id) }}">
      <button class="btn btn-md btn-inverse-success edit-product-btn">Edit</button>
    </a>
  </td>
  <td><button class="btn btn-md btn-inverse-danger delete-product-btn"
        onclick="if (!confirm('Are you sure you want to delete this product?')) return false;"
        data-id="{{ $product->id }}"
        data-token="{{ csrf_token() }}">Delete</button>

  </td>
</tr>
@endforeach