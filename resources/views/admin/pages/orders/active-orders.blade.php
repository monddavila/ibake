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

      {{-- {{ dd($activeOrders) }} --}}
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Shop Orders</h4>
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th> Order ID </th>
                          <th> Order Date</th>
                          <th> Delivery Date
                          <a href="{{ route('activeOrders') }}?sort_by=delivery_date&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('activeOrders') }}?sort_by=delivery_date&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Time </th>
                          <th> Recipient Name </th>
                          <th> Recipient Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Payment Status </th>
                          <th> Delivery Notes </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($activeOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Active Orders Available</div>
                              </td>
                          </tr>
                      @else
                        
                        @foreach ($activeOrders as $order)
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
                            <td>{{ $order->payment_status }}</td>
                            <td>
                                <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->notes }}</textarea>
                            </td>
                            <td>
                              <div class="badge badge-outline-warning">{{ $order->order_status }}</div>
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
                                                        <div class="col">
                                                        <label>Product Name:</label>
                                                            <span><i>{{ $orderItem->product->name }}</i></span><br>
                                                            <label>Quantity:</label>
                                                            <span><i>{{ $orderItem->quantity }}</i></span><br>
                                                            <label>Price:</label>
                                                            <span><i>{{ $orderItem->product->price }}</i></span><br>
                                                        </div>
                                                        <div class="col">
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
                                                    <div align="right">
                                                      <span>Price: &#8369; {{ number_format($totalPrice, 2) }}</span>
                                                    </div>
                                                  </div>
                                        </div>
                                              
                                      <form action="{{ route('processOrderStatus', ['id' => $order->order_id]) }}" method="post"> 
                                          @csrf
                                          <input type="hidden" value="1" name="isSelectionOrder">
                                          
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="submit" class="btn badge-outline-success process-button " name="action" value="Process">Process</button>
                                              <button type="submit" class="btn badge-outline-danger cancel-button" name="action" value="Cancel">Cancel Order</button>

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
                  {{ $activeOrders->links() }} <!-- Custom Cake Orders Pagination Links -->
                </div>
              </div>
            </div>
          </div>

          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Custom Cake Orders</h4>
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th> Order ID </th>
                          <th> Order Date</th>
                          <th> Delivery Date
                          <a href="{{ route('activeOrders') }}?sort_by=delivery_date&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('activeOrders') }}?sort_by=delivery_date&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Time </th>
                          <th> Recipient Name </th>
                          <th> Recipient Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Payment Status </th>
                          <th> Delivery Notes </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($activeCustomOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Active Orders Available</div>
                              </td>
                          </tr>
                      @else
                        
                        @foreach ($activeCustomOrders as $order)
                          <tr>
                          
                            <td data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->customizeOrder->orderID  }}">
                              <button class="btn btn-md btn-inverse-success order-details-btn">View
                                Order</button>
                            </td>
                            <td>{{ $order->customizeOrder->orderID }}</td>
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
                            <td>{{ $order->payment_status }}</td>
                            <td>
                                <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->notes }}</textarea>
                            </td>
                            <td>
                              <div class="badge badge-outline-warning">{{ $order->order_status }}</div>
                            </td>
                          </tr>

                          <!-- Modal -->
                          <div class="modal fade" id="staticBackdrop{{ $order->customizeOrder->orderID }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Order No. {{ $order->customizeOrder->orderID }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    @if($order->customizeOrder->isSelectionOrder == 2)
                                      <div align="center">
                                        <a href="{{ asset($order->customizeOrder->cakeOrderImage) }}">
                                        <img src="{{ asset($order->customizeOrder->cakeOrderImage) }}" style="max-width: auto;max-height: 250px;">
                                        </a>
                                      </div>
                                      
                                    @endif
                                    <!-- details -->
                                    @if($order->customizeOrder->isSelectionOrder == 1)
                                      <div class="card">
                                        <div class="card-body">
                                          <label>Size:</label>
                                            <span><i>{{ $order->customizeOrder->cakeSize }}</i></span><br>
                                          <label>Flavor:</label>
                                            <span><i>{{ $order->customizeOrder->cakeFlavor }}</i></span><br>
                                          <label>Filling:</label>
                                            <span><i>{{ $order->customizeOrder->cakeFilling }}</i></span><br>
                                          <label>Icing:</label>
                                            <span><i>{{ $order->customizeOrder->cakeIcing }}</i></span><br>
                                          <label>Top Border:</label>
                                            <span><i>{{ $order->customizeOrder->cakeTopBorder }}</i></span><br>
                                          <label>Bottom Border:</label>
                                            <span><i>{{ $order->customizeOrder->cakeBottomBorder }}</i></span><br>
                                          <label>Decoration:</label>
                                            <span><i>{{ $order->customizeOrder->cakeDecoration }}</i></span><br>
                                          <label>Cake Message:</label>
                                            <span><i>{{ $order->customizeOrder->cakeMessage }}</i></span><br>
                                          <hr>
                                          <div align="right">
                                            <span>&#8369; {{ number_format($order->customizeOrder->cakePrice, 2) }}</span>
                                          </div>
                                        </div>
                                      </div>
                                    @endif
                                    @if($order->customizeOrder->isSelectionOrder == 2)
                                    <hr>
                                      <label>Additional Info.</label>
                                      <textarea class="form-control" rows="10" spellcheck="false" style="color:black;" readonly>{{ $order->customizeOrder->cakeMessage  }}</textarea>
                                    <hr>
                                    <div align="right">
                                                      <span>Price: &#8369; {{ number_format($order->customizeOrder->cakePrice, 2) }}</span>
                                                    </div>
                                    @endif
                                    <form action="{{ route('processOrderStatus', ['id' => $order->customizeOrder->orderID]) }}" method="post"> 
                                        @csrf
                                        <input type="hidden" value="2" name="isSelectionOrder">
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn badge-outline-success process-button" name="action" value="Process">Process</button>
                                            <button type="submit" class="btn badge-outline-danger cancel-button" name="action" value="Cancel">Cancel Order</button>

                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                        @endforeach

                      @endif 
                      </tbody>
                    </table>
                  </div>
                  {{ $activeCustomOrders->links() }} <!-- Custom Cake Orders Pagination Links -->
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
  <script>
    document.querySelectorAll(".cancel-button").forEach(function(button) {
    button.addEventListener("click", function (event) {
        if (!confirm("Are you sure you want to cancel this order? The item is already paid, and the customer may be eligible for a refund. Please notify the customer of this possibility.")) {
            event.preventDefault(); // Prevent the form submission if the user cancels
        }
    });
    });

  </script>

  <script>
    document.querySelectorAll(".process-button").forEach(function(button) {
    button.addEventListener("click", function (event) {
        if (!confirm("Are you sure you want to mark the order as processing? The order must be in the process of being processed before you can mark it as such.")) {
            event.preventDefault(); // Prevent the form submission if the user cancels
        }
    });
    });

  </script>

  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-orders.js') }}"></script>
  <!-- JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  


</body>

</html>