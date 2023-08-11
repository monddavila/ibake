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
                  <h4 class="card-title">Order Status</h4>
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th> Client Name </th>
                          <th> Order No. </th>
                          <th> Total Order Cost </th>
                          <th> Payment Status </th>
                          <th> Payment Mode </th>
                          <th> Order Date </th>
                          <th> Delivery Date </th>
                          <th> Order Status </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($activeOrders as $order)
                        <tr>
                          <td>
                            <span class="ps-2">{{ $order->recipient_name }}</span>
                          </td>
                          <td>{{ $order->id }}</td>
                          <td>{{ $order->total_price }}</td>
                          <td>TBA</td>
                          <td>{{ $order->payment_method }}</td>
                          <td>{{ $order->created_at->format('d M Y') }}</td>
                          <td>{{ $order->delivery_date }}</td>
                          <td>
                            @if ($order->order_status == 'Pending')
                            <div class="badge badge-outline-warning">{{ $order->order_status }}</div>
                            @else
                            <div class="badge badge-outline-primary">{{ $order->order_status }}</div>
                            @endif
                          </td>
                        </tr>
                        @endforeach

                        <tr>
                          <td>
                            <span class="ps-2">Estella Bryan</span>
                          </td>
                          <td> 02312 </td>
                          <td> $14,500 </td>
                          <td> Website </td>
                          <td> Cash on delivered </td>
                          <td> 04 Dec 2019 </td>
                          <td> 04 Dec 2019 </td>
                          <td>
                            <div class="badge badge-outline-warning">Pending</div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span class="ps-2">Lucy Abbott</span>
                          </td>
                          <td> 02312 </td>
                          <td> $14,500 </td>
                          <td> App design </td>
                          <td> Credit card </td>
                          <td> 04 Dec 2019 </td>
                          <td> 04 Dec 2019 </td>
                          <td>
                            <div class="badge badge-outline-danger">Rejected</div>
                          </td>
                        </tr>
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
  </div>

  <!-- plugins:js -->
  @include('admin.partials.script')
</body>

</html>