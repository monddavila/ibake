<!DOCTYPE html>
<html lang="en">

<head>
  @include('customer.partials.head')

</head>

<body>
  <div class="container-scroller">

    @include('customer.partials.sidebar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:navbar -->
      @include('customer.partials.navbar')

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Shop Orders</h4>
                  <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th> Order ID </th>
                          <th> Order Requested
                          <a href="{{ route('customerCompletedOrder') }}?sort_by=created_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('customerCompletedOrder') }}?sort_by=created_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Order Completed
                          <a href="{{ route('customerCompletedOrder') }}?sort_by=updated_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('customerCompletedOrder') }}?sort_by=updated_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Date</th>
                          <th> Delivery Time </th>
                          <th> Recipient Name </th>
                          <th> Recipient Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($completedOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Shop Order History Available</div>
                              </td>
                          </tr>
                      @else
                        
                        @foreach ($completedOrders as $order)
                          <tr>
                          
                            <td data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->order_id }}">
                              <button class="btn btn-md btn-inverse-success order-details-btn">View
                                Order</button>
                            </td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ $order->updated_at->format('d M Y') }}</td>
                            <td>{{ $order->delivery_date }}</td>
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
                            <?php if ($order->order_status == 'Completed'): ?>
                                    <div class="badge badge-outline-success">Completed</div>
                                  <?php elseif($order->order_status == 'Refunded'): ?>
                                    <div class="badge badge-outline-warning">Processing</div>
                                  <?php elseif($order->order_status == 'Cancelled'): ?>
                                    <div class="badge badge-outline-danger">Cancelled</div>
                                <?php endif ?>
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
                                                @endforeach<div style="padding-left: 20px;">
                                                  <div style="display: inline-block; text-align: left;">
                                                      <label>Payment Status:</label>
                                                      <span><i>{{ $order->payment_status }}</i></span><br>
                                                      <label>Recipient Name:</label>
                                                      <span><i>{{ $order->recipient_name}}</i></span><br>
                                                      @if($order->order_status == 'Completed')
                                                      <label>Date Completed:</label>
                                                      @else
                                                      <label>Date Cancelled:</label>
                                                      @endif
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
                                                      <span><i>{{ $order->delivery_address }}</i></span><br>
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
                                          <input type="hidden" value="{{ $order->order_id }}" name="isSelectionOrder">
                                          
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
                </div>
              </div>
            </div>
          </div>

          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Custom Cake Orders</h4>
                  <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th> Order ID </th>
                          <th> Order Requested
                          <a href="{{ route('customerCompletedOrder') }}?sort_by=created_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('customerCompletedOrder') }}?sort_by=created_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Order Completed
                          <a href="{{ route('customerCompletedOrder') }}?sort_by=updated_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('customerCompletedOrder') }}?sort_by=updated_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Date</th>
                          <th> Delivery Time </th>
                          <th> Recipient Name </th>
                          <th> Recipient Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($completedCustomOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Custom Cake Order History Available</div>
                              </td>
                          </tr>
                      @else
                        
                        @foreach ($completedCustomOrders as $order)
                          <tr>
                          
                            <td data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->customizeOrder->orderID  }}">
                              <button class="btn btn-md btn-inverse-success order-details-btn">View
                                Order</button>
                            </td>
                            <td>{{ $order->customizeOrder->orderID }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ $order->updated_at->format('d M Y') }}</td>
                            <td>{{ $order->delivery_date }}</td>
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
                              <div class="badge badge-outline-success">{{ $order->order_status }}</div>
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
                                          <label>Cake Dedication:</label>
                                            <span><i>{{ $order->customizeOrder->cakeMessage }}</i></span><br>
                                          <label>Celebrant Name:</label>
                                            <span><i>{{ $order->customizeOrder->celebrant_name}}</i></span><br>
                                          <label>Celebrant Birthday:</label>
                                            @php
                                                $birthday = $order->customizeOrder->celebrant_birthday;

                                                if ($birthday) {
                                                    $parsedDate1 = date('F-d-Y', strtotime($birthday));
                                                }
                                            @endphp

                                            @if (isset($parsedDate1))
                                                <span><i>{{$parsedDate1 }}</i></span>
                                            @endif
                                            <br>
                                            @php
                                                $birthday = $order->customizeOrder->celebrant_birthday;
                                                $age = null;

                                                if ($birthday !== null) {
                                                    $birthday = date('Y-m-d', strtotime($birthday));
                                                    $currentDate = \Carbon\Carbon::now();

                                                    $age = $currentDate->diffInYears($birthday);
                                                }
                                            @endphp

                                            @if ($age !== null)
                                                <span><i> (currently {{ $age }} years old)</i></span><br>
                                            @endif
                                          <hr>
                                                      <label>Payment Status:</label>
                                                      <span><i>{{ $order->payment_status }}</i></span><br>
                                                      <label>Payment Option:</label>
                                                      <span><i>{{ $order->payment_option }}</i></span><br>
                                                      <label>Recipient Name:</label>
                                                      <span><i>{{ $order->recipient_name}}</i></span><br>
                                                      @if($order->order_status == 'Completed')
                                                      <label>Date Completed:</label>
                                                      @else
                                                      <label>Date Cancelled:</label>
                                                      @endif
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
                                                      <span><i>{{ $order->delivery_address }}</i></span><br>
                                                      @endif
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
                                    <label>Cake Size:</label>
                                          <span><i>{{ $order->customizeOrder->cake_size}}</i></span><br>
                                        <label>Cake Flavor:</label>
                                          <span><i>{{ $order->customizeOrder->cake_flavor }}</i></span><br>
                                        <label>Cake Icing:</label>
                                          <span><i>{{ $order->customizeOrder->cake_icing }}</i></span><br>
                                        <label>Celebrant Name:</label>
                                            <span><i>{{ $order->customizeOrder->celebrant_name}}</i></span><br>
                                        <label>Celebrant Birthday:</label>
                                            @php
                                                $birthday = $order->customizeOrder->celebrant_birthday;

                                                if ($birthday) {
                                                    $parsedDate2 = date('F-d-Y', strtotime($birthday));
                                                }
                                            @endphp

                                            @if (isset($parsedDate2))
                                                <span><i>{{$parsedDate2 }}</i></span>
                                            @endif
                                            <br>
                                            @php
                                                $birthday = $order->customizeOrder->celebrant_birthday;
                                                $age = null;

                                                if ($birthday !== null) {
                                                    $birthday = date('Y-m-d', strtotime($birthday));
                                                    $currentDate = \Carbon\Carbon::now();

                                                    $age = $currentDate->diffInYears($birthday);
                                                }
                                            @endphp

                                            @if ($age !== null)
                                                <span><i> (currently {{ $age }} years old)</i></span><br>
                                            @endif
                                    <hr>
                                                      <label>Payment Status:</label>
                                                      <span><i>{{ $order->payment_status }}</i></span><br>
                                                      <label>Payment Option:</label>
                                                      <span><i>{{ $order->payment_option }}</i></span><br>
                                                      <label>Recipient Name:</label>
                                                      <span><i>{{ $order->recipient_name}}</i></span><br>
                                                      @if($order->order_status == 'Completed')
                                                      <label>Date Completed:</label>
                                                      @else
                                                      <label>Date Cancelled:</label>
                                                      @endif
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
                                                      <span><i>{{ $order->delivery_address }}</i></span><br>
                                                      @endif
                                    <hr>
                                    <div align="right">
                                                      <span>Price: &#8369; {{ number_format($order->customizeOrder->cakePrice, 2) }}</span>
                                                    </div>
                                    @endif
                                    <form action="{{ route('processOrderStatus', ['id' => $order->customizeOrder->orderID]) }}" method="post"> 
                                        @csrf
                                        <input type="hidden" value="{{ $order->customizeOrder->isSelectionOrder }}" name="isSelectionOrder">
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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
                </div>
              </div>
            </div>
          </div>


        </div>
        <!-- content-wrapper ends -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © iBake Tiers of Joy
              <?php echo date('Y'); ?><a href="{{route('terms')}}"> Terms</a> | <a href="{{route('privacy')}}">Privacy</a></span>
            </div>
          </footer>
          <!-- partial -->
      </div>

      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    



  <!-- plugins:js -->

  @include('customer.partials.script')
  <script src="{{ asset('customer/assets/js/customer-orders.js') }}"></script>
  <!-- JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="//code.tidio.co/rxspxjqfeocjtadtyjrdmxudlhr0m8vc.js" async></script>

  


</body>

</html>