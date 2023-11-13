<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.partials.head')

</head>

<body>
  <div class="container-scroller">

    @include('admin.partials.sidebar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:navbar -->
      @include('admin.partials.navbar')

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  
                  <div class="d-flex justify-content-between align-items-center">
                  <h4 class="card-title">Shop Orders</h4>
                  <a href="{{ route('exportShopRecords') }}" class="btn btn-success me-2">
                      <i class="fas fa-download"></i> Export
                  </a>
                  </div>
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th> Order ID </th>
                          <th> Order Date
                          <a href="{{ route('shopOrders') }}?sort_by=created_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('shopOrders') }}?sort_by=created_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Date
                          <a href="{{ route('shopOrders') }}?sort_by=delivery_date&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('shopOrders') }}?sort_by=delivery_date&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Time </th>
                          <th> Recipient Name </th>
                          <th> Recipient Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Delivery Notes </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($shopOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Shop Orders Available</div>
                              </td>
                          </tr>
                      @else
                        
                        @foreach ($shopOrders as $order)
                          <tr>
                          
                            <td data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->order_id }}">
                              <button class="btn btn-md btn-inverse-success order-details-btn">View
                                Order</button>
                            </td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->delivery_time)->format('g:i A') }}</td>
                            <td>
                              <span class="ps-2">{{ $order->recipient_name }}</span>
                            </td>
                            <td>+63{{ $order->recipient_phone }}</td>
                            <td>
                                <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->delivery_address }}</textarea>
                            </td>
                            <td>{{ $order->shipping_method }}</td>
                            <td>
                                <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->notes }}</textarea>
                            </td>
                            <td>
                                @if($order->order_status == 'Completed')
                              <div class="badge badge-outline-success">{{ $order->order_status }}</div>
                              @elseif($order->order_status == 'Pending')
                              <div class="badge badge-outline-warning">{{ $order->order_status }}</div>
                              @elseif($order->order_status == 'Processing')
                              <div class="badge badge-outline-primary">{{ $order->order_status }}</div>
                              @elseif($order->order_status == 'On Delivery')
                              <div class="badge badge-outline-info">For Pickup/Delivery</div>
                              @elseif($order->order_status == 'Cancelled')
                              <div class="badge badge-outline-danger">{{ $order->order_status }}</div>
                              @endif
                            </td>
                          </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop{{ $order->order_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Order No. {{ $order->order_id }}</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                        <div class="modal-body">
                                                    @php
                                                    $totalPrice = 0; // Initialize the total price variable
                                                    @endphp
                                                @foreach ($order->orderItems as $orderItem)
                                                  <!-- details -->
                                                  <div class="card">
                                                    <div class="card-body">
                                                      <div class="row">
                                                        <div class="col-md-8">
                                                        <label>Product Name:</label>
                                                            <span><i>{{ $orderItem->product->name }}</i></span><br>
                                                            <label>Quantity:</label>
                                                            <span><i>{{ $orderItem->quantity }}</i></span><br>
                                                            <label>Price:</label>
                                                            <span><i>₱ {{ $orderItem->product->price }}</i></span><br>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="{{ asset($orderItem->product->image) }}" data-lightbox="image">
                                                                <img src="{{ asset($orderItem->product->image) }}" style="float: right; max-width: auto; max-height: 80px;">
                                                            </a>
                                                        </div>
                                                      </div>
                                                    </div>
                                                      <hr>
                                                      @php
                                                      $totalPrice += $orderItem->quantity * $orderItem->product->price;
                                                      @endphp
                                                @endforeach
                                                <div style="padding-left: 20px;">
                                                  <div style="display: inline-block; text-align: left;">
                                                      <label>Requestor Name:</label>
                                                      <span><i>{{ $order->user->firstname }} {{ $order->user->lastname }}</i></span><br>
                                                      <label>Recipient Name:</label>
                                                      <span><i>{{ $order->recipient_name}}</i></span><br>
                                                      <label>Date Completed:</label>
                                                      <span><i>{{ $order->updated_at->format('d M Y') }}</i></span><br>
                                                      <label>Shipping Method:</label>
                                                      <span><i>{{ $order->shipping_method }}</i></span><br>
                                                      <label>Date Needed:</label>
                                                      <span><i>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}</i></span><br>
                                                      <label>Time:</label>
                                                      <span><i>{{ \Carbon\Carbon::parse($order->delivery_time)->format('g:i A') }}</i></span><br>
                                                      <label>Notes:</label>
                                                      <span><i>{{ $order->notes }}</i></span><br>
                                                      @if ($order->shipping_method == 'Delivery')
                                                      <label>Address:</label>
                                                      <span><i>{{ str_replace('||', ', ', $order->delivery_address) }}</i></span><br>
                                                      @endif
                                                  </div>
                                                </div>

                                                      <hr>
                                                    <div align="right">
                                                      <span>Total Price: &#8369; {{ number_format($totalPrice, 2) }}</span>
                                                    </div>
                                                  </div>
                                        </div>
                                              
                                      <form action="{{ route('processOrderStatus', ['id' => $order->order_id]) }}" method="post"> 
                                          @csrf
                                          <input type="hidden" value="1" name="isSelectionOrder">
                                          
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>


                                          </div>
                                      </form>
                                    </div>
                                  </div>
                            </div>
                            
                        @endforeach

                      @endif 
                      </tbody>
                    </table>
                  </div>
                  {{ $shopOrders->links() }} <!--  Cake Orders Pagination Links -->
                </div>
              </div>
            </div>
          </div>

          


        </div>
        @include('admin.partials.footer')
      </div>

      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->



  <!-- plugins:js -->

  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-orders.js') }}"></script>
  <!-- JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  


</body>

</html>