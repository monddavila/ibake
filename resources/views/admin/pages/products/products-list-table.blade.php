@foreach ($products as $product)
<tr id="product-{{ $product->id }}">
  <td class="product-name" data-toggle="modal" data-target="#myModal">{{ $product->name }}</td>
  <td>{{ $product->price }}</td>
  <td>{{ $product->category }}</td>
  <td>{{ $product->rating }}</td>
  <td>TBD</td>
  {{-- <td><a href="#"><i class="mdi mdi-image-area product-img"></i></a></td> --}}
  <td><button class="btn btn-md btn-inverse-success edit-product-btn" data-productId="{{ $product->id }}">Edit</button>
  </td>
  <td><button class="btn btn-md btn-inverse-danger delete-product-btn" data-id="{{ $product->id }}"
      data-token="{{ csrf_token() }}">Delete</button></td>
  </td>
</tr>
@endforeach