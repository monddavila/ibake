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
                  <h4 class="card-title">Shop Orders</h4>
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th> Order ID </th>
                          <th> Order Date</th>
                          <th> Prepared
                          <a href="{{ route('readyOrders') }}?sort_by=updated_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('readyOrders') }}?sort_by=updated_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Date
                          <a href="{{ route('readyOrders') }}?sort_by=delivery_date&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('readyOrders') }}?sort_by=delivery_date&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Time </th>
                          <th> Recipient Name </th>
                          <th> Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Payment Status </th>
                          <th> Delivery Notes </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($readyOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Ready Orders Available</div>
                              </td>
                          </tr>
                      @else
                        
                        @foreach ($readyOrders as $order)
                          <tr>
                          
                            <td data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->order_id }}">
                              <button class="btn btn-md btn-inverse-success order-details-btn">Manage
                                Order</button>
                            </td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ $order->updated_at->format('d M Y') }}</td>
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
                              <div class="badge badge-outline-primary">{{ $order->order_status }}</div>
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
                                                      <label>Requestor Phone:</label>
                                                      <span><i>{{ $order->user->phone }}</i></span><br>
                                                      <label>Recipient Name:</label>
                                                      <span><i>{{ $order->recipient_name}}</i></span><br>
                                                      <label>Recipient Phone:</label>
                                                      <span><i>0{{ $order->recipient_phone }}</i></span><br>
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
                                                      <span>Price: &#8369; {{ number_format($totalPrice, 2) }}</span>
                                                    </div>
                                                  </div>
                                        </div>
                                              
                                      <form action="{{ route('processOrderStatus', ['id' => $order->order_id]) }}" method="post"> 
                                          @csrf
                                          <input type="hidden" value="1" name="isSelectionOrder">
                                          @php
                                              $userType = auth()->user()->role_id;
                                          @endphp
                                          
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              @if ($userType == '3' || $userType == '4')
                                              <button type="submit" class="btn badge-outline-success ready-button" name="action" value="Complete">Complete Order</button>
                                              @endif

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
                  {{ $readyOrders->links() }} <!--  Cake Orders Pagination Links -->
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
                          <th> Prepared
                          <a href="{{ route('readyOrders') }}?sort_by=updated_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('readyOrders') }}?sort_by=updated_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Date
                          <a href="{{ route('readyOrders') }}?sort_by=delivery_date&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                          <a href="{{ route('readyOrders') }}?sort_by=delivery_date&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                          </th>
                          <th> Delivery Time </th>
                          <th> Recipient Name </th>
                          <th> Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Payment Status </th>
                          <th> Delivery Notes </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($readyCustomOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Ready Orders Available</div>
                              </td>
                          </tr>
                      @else
                        
                        @foreach ($readyCustomOrders as $order)
                          <tr>
                          
                            <td data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->customizeOrder->orderID  }}">
                              <button class="btn btn-md btn-inverse-success order-details-btn">Manage
                                Order</button>
                            </td>
                            <td>{{ $order->customizeOrder->orderID }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ $order->updated_at->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->delivery_time)->format('g:i A') }}</td>
                            <td>
                              <span class="ps-2">{{ $order->recipient_name }}</span>
                            </td>
                            <td>+63{{ $order->recipient_phone }}</td>
                            <td>
                                <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ str_replace('||', ', ', $order->delivery_address) }}</textarea>
                            </td>
                            <td>{{ $order->shipping_method }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>
                                <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->notes }}</textarea>
                            </td>
                            <td>
                              <div class="badge badge-outline-primary">{{ $order->order_status }}</div>

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
                                                      <label>Requestor Name:</label>
                                                      <span><i>{{ $order->user->firstname }} {{ $order->user->lastname }}</i></span><br>
                                                      <label>Requestor Phone:</label>
                                                      <span><i>{{ $order->user->phone }}</i></span><br>
                                                      <label>Recipient Name:</label>
                                                      <span><i>{{ $order->recipient_name}}</i></span><br>
                                                      <label>Recipient Phone:</label>
                                                      <span><i>0{{ $order->recipient_phone }}</i></span><br>
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
                                                      <label>Requestor Name:</label>
                                                      <span><i>{{ $order->user->firstname }} {{ $order->user->lastname }}</i></span><br>
                                                      <label>Requestor Phone:</label>
                                                      <span><i>{{ $order->user->phone }}</i></span><br>
                                                      <label>Recipient Name:</label>
                                                      <span><i>{{ $order->recipient_name}}</i></span><br>
                                                      <label>Recipient Phone:</label>
                                                      <span><i>0{{ $order->recipient_phone }}</i></span><br>
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
                                    <hr>
                                    <div align="right">
                                                      <span>Price: &#8369; {{ number_format($order->customizeOrder->cakePrice, 2) }}</span>
                                                    </div>
                                    @endif

                                    @php
                                          $userType = auth()->user()->role_id;
                                    @endphp
                                  
                                    @if ($userType == '3' || $userType == '4')

                                      <form action="{{ route('processOrderStatus', ['id' => $order->customizeOrder->orderID]) }}" method="post"> 
                                          @csrf
                                          <input type="hidden" value="2" name="isSelectionOrder">

                                          {{--Validate payment status before proceeding to complete order--}}

                                          @if ($order->payment_status == "Partially Paid" && $order->payment_option == "Half-online")
                                          <hr>
                                          <p> The customer's payment balance has not yet been processed, so their order cannot be completed. Please ask the customer to pay their balance online to complete their order.</p>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          </div>
                                          @elseif ($order->payment_status == "Partially Paid" && $order->payment_option == "Half-cod")
        
                                          <hr>
                                          
                                              <div class="d-flex justify-content-center">
                                                  <div class="form-check">
                                                      <input type="checkbox" class="form-check-input" id="confirmPayment" required>
                                                      <label class="form-check-label" for="confirmPayment" style="color:blue">Check to confirm that the balance payment is already settled<br>
                                                      <span style="color:black">(Payment balance due upon delivery or pickup)</span></label>
                                                  </div>
                                              </div>

                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn badge-outline-success ready-button" id="confirmPaymentButton" name="action" value="Complete" disabled>Complete Order</button>
                                              </div>
                                          @else
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  
                                                  <button type="submit" class="btn badge-outline-success ready-button"  name="action" value="Complete">Complete Order</button>
                                                  
                                              </div>
                                          @endif
                                      </form>
                                    @endif
                                    

                                  </div>
                                </div>
                              </div>
                            </div>

                        @endforeach

                      @endif 
                      </tbody>
                    </table>
                  </div>
                  {{ $readyCustomOrders->links() }} <!--  Cake Orders Pagination Links -->
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
    document.addEventListener("DOMContentLoaded", function() {
        // Get references to the checkbox and button elements
        var confirmPaymentCheckbox = document.getElementById("confirmPayment");
        var confirmPaymentButton = document.getElementById("confirmPaymentButton");

        // Function to handle the checkbox change event
        function handleCheckboxChange() {
            if (confirmPaymentCheckbox.checked) {
                confirmPaymentButton.removeAttribute("disabled");
            } else {
                confirmPaymentButton.setAttribute("disabled", "disabled");
            }
        }

        // Attach an event listener to the checkbox to handle changes
        confirmPaymentCheckbox.addEventListener("change", handleCheckboxChange);

        // Initially set the button state based on the checkbox state
        handleCheckboxChange();
    });
  </script>


  <script>
    document.querySelectorAll(".ready-button").forEach(function(button) {
    button.addEventListener("click", function (event) {
        if (!confirm("Mark order as completed? Order must be delivered or picked up already.")) {
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