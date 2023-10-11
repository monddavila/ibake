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
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th> Order ID </th>
                          <th> Order Date</th>
                          <th> Delivery Date </th>
                          <th> Delivery Time </th>
                          <th> Recepient Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Delivery Notes </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($completedOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Orders History Available</div>
                              </td>
                          </tr>
                      @else
                        @foreach ($completedOrders as $order)
                        <tr>
                          <td data-toggle="modal" data-target="#activeOrderModal">
                            <button class="btn btn-md btn-inverse-success order-details-btn">View
                              Order</button>
                          </td>
                          <td>{{ $order->order_id }}</td>
                          <td>{{ $order->created_at->format('d M Y') }}</td>
                          <td>{{ $order->delivery_date }}</td>
                          <td>{{ \Carbon\Carbon::parse($order->delivery_time)->format('g:i A') }}</td>
                          <td>+63{{ $order->recipient_phone }}</td>
                          <td>
                              <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->delivery_address }}</textarea>
                          </td>
                          <td>{{ $order->shipping_method }}</td>
                          <td>
                              <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->notes }}</textarea>
                          </td>
                          <td>
                            @if ($order->order_status == 'Pending')
                            <div class="badge badge-outline-warning">{{ $order->order_status }}</div>
                            @else
                            <div class="badge badge-outline-success">{{ $order->order_status }}</div>
                            @endif
                          </td>
                        </tr>
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
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th></th>
                          <th> Order ID </th>
                          <th> Order Date</th>
                          <th> Delivery Date </th>
                          <th> Delivery Time </th>
                          <th> Recepient Phone </th>
                          <th> Delivery Address </th>
                          <th> Shipping Method </th>
                          <th> Delivery Notes </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                      @if ($completedCustomOrders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Orders History Available</div>
                              </td>
                          </tr>
                      @else
                        @foreach ($completedCustomOrders as $order)
                        <tr>
                          <td data-toggle="modal" data-target="#activeOrderModal">
                            <button class="btn btn-md btn-inverse-success order-details-btn">View
                              Order</button>
                          </td>
                          <td>{{ $order->customizeOrder->orderID }}</td>
                          <td>{{ $order->created_at->format('d M Y') }}</td>
                          <td>{{ $order->delivery_date }}</td>
                          <td>{{ \Carbon\Carbon::parse($order->delivery_time)->format('g:i A') }}</td>
                          <td>+63{{ $order->recipient_phone }}</td>
                          <td>
                              <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->delivery_address }}</textarea>
                          </td>
                          <td>{{ $order->shipping_method }}</td>
                          <td>
                              <textarea readonly style="width: 175px; height: 35px; overflow: auto;">{{ $order->notes }}</textarea>
                          </td>
                          <td>
                            @if ($order->order_status == 'Cancelled')
                                <div class="badge badge-outline-primary">{{ $order->order_status }}</div>
                                @else
                                @if ($order->order_status == 'Refunded')
                                <div class="badge badge-outline-primary">{{ $order->order_status }}</div>
                                @else
                                <div class="badge badge-outline-success">{{ $order->order_status }}</div>
                                @endif
                            @endif
                          </td>
                        </tr>
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
      </div>

      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->


    <!-- Button trigger modal
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Order Details Modal -->
  {{-- <div class="modal fade" id="activeOrderModal" tabindex="-1" role="img" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title"></h5>
        </div>
      </div>
    </div>
  </div> --}}
  <!-- Order Details Modal End -->

  <!-- plugins:js -->
  @include('customer.partials.script')
  <script src="{{ asset('customer/assets/js/customer-orders.js') }}"></script>
  <!-- JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>