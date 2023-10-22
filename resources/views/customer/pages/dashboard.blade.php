<div class="main-panel">
  <div class="content-wrapper">
              
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif



    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Order Requests</h4>
            <div class="table-responsive" style="max-height: 700px; overflow-y: auto;">
              <table class="table" id="orders-table">
                <thead>
                  <tr>
                    <th> Status
                      <a href="{{ route('customer') }}?sort_by=orderStatus&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                      <a href="{{ route('customer') }}?sort_by=orderStatus&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                    </th>
                    <th> Request No. </th>
                    <th> Date Requested
                      <a href="{{ route('customer') }}?sort_by=created_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                      <a href="{{ route('customer') }}?sort_by=created_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                    </th>
                    <th>Date Needed</th>
                    <th> Request Reviewed
                      <a href="{{ route('customer') }}?sort_by=updated_at&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                      <a href="{{ route('customer') }}?sort_by=updated_at&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                    </th>
                    <th> Uploaded Image </th>
                    <th>Payment Option</th>
                    <th> Price
                      <a href="{{ route('customer') }}?sort_by=cakePrice&order_by=asc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-up"></i></a>
                      <a href="{{ route('customer') }}?sort_by=cakePrice&order_by=desc" style="text-decoration: none; color: black;"><i class="sort-icon mdi mdi-arrow-down"></i></a>
                    </th>
                    <th>Balance</th>
                  </tr>
                </thead>
                <tbody>
                @if ($orders->isEmpty())
                          <tr>
                              <td colspan="11" class="text-center">
                                  <div class="order-info">No Pending Orders Available</div>
                              </td>
                          </tr>
                      @else
                  @foreach($orders as $key => $value)
                    <tr>
                      <td>
                          <?php if ($value->orderStatus == 1): ?>
                              <div class="d-flex align-items-center">
                                  <div class="badge badge-outline-warning">Awaiting Approval</div>
                                  <form action="{{ route('cake-request.cancel', ['id' => $value->orderID]) }}" method="post">
                                      @csrf
                                      <button id="cancel-request" type="submit" class="badge badge-outline-success btn-danger" style="text-decoration: none;"
                                          onclick="confirmCancel('{{ $value->orderID }}', event)">Cancel</button>
                                  </form>
                              </div>
                          <?php elseif($value->orderStatus == 2): ?>
                              <form action="{{ route('cake-request.process', ['id' => $value->orderID]) }}" method="post">
                                  @csrf
                                  <button type="submit" class="badge badge-outline-success btn-success" style="text-decoration: none;">Pay Now</button>
                              </form>
                          <?php elseif($value->orderStatus == 5): ?>
                              <div class="badge badge-outline-danger">Rejected</div>
                          <?php elseif($value->orderStatus == 4): ?>
                              <div class="badge badge-outline-primary">Fully Paid</div>
                          <?php elseif($value->orderStatus == 7): ?>
                              <div class="badge badge-outline-info">Cancelled</div>
                          <?php elseif($value->orderStatus == 3): ?>
                            <form action="{{ route('payment-balance.process', ['id' => $value->orderID]) }}" method="post">
                              @csrf

                                @if ($value->customizeOrderDetail)
                                    @if ($value->customizeOrderDetail->payment_option == 'Half-online')
                                        <button type="submit" class="badge badge-outline-success btn-success" style="text-decoration: none;">Pay Balance</button>
                                    @elseif ($value->customizeOrderDetail->payment_option == 'Half-cod')
                                        <div class="badge badge-outline-success">Partially Paid</div>
                                    @endif
                                </form>
                                @endif

                          <?php endif ?>
                      </td>

                              <script>
                                  function confirmCancel(orderID, event) {
                                      if (confirm("Are you sure you want to cancel this custom cake request?")) {
                                          // If the user confirms, do nothing (let the form submit)
                                      } else {
                                          // If the user cancels, prevent the default form submission
                                          event.preventDefault();
                                      }
                                  }
                              </script>


                      <td>
                          <a href="#" class="btn" style="text-decoration: none; color: grey ;" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $value->orderID }}" onmouseover="this.style.color='red'" onmouseout="this.style.color='grey'">
                              {{ $value->orderID }}
                          </a>

                      </td>

                      <td>
                          {{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('d M Y') : '-' }}
                      </td>
                      <td>Date Needed</td>
                      <td>
                          {{ $value->updated_at ? \Carbon\Carbon::parse($value->updated_at)->format('d M Y') : '-' }}
                      </td>
                      <td>
                                @if (!empty($value->cakeOrderImage))
                                    <a href="{{ asset($value->cakeOrderImage) }}" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i>View Image</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($value->customizeOrderDetail)
                                    {{ $value->customizeOrderDetail->payment_option }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if (!empty($value->cakePrice) && !is_null($value->cakePrice))
                                    &#8369; {{ number_format($value->cakePrice, 2) }}
                                @else
                                    -
                                @endif
                            </td>
                      <td>
                                @if ($value->customizeOrderDetail)
                                      @if($value->customizeOrderDetail->payment_balance !== null)
                                       &#8369; {{ $value->customizeOrderDetail->payment_balance }}
                                      @else
                                      -
                                      @endif
                                @else
                                    -
                                @endif
                      </td>

                    </tr>
                    <div class="modal fade" id="staticBackdrop{{ $value->orderID  }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Order No. {{ $value->orderID  }}</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  @if($value->isSelectionOrder == 2)
                                    <div align="center">
                                      <img src="{{ asset($value->cakeOrderImage) }}" style="max-width: auto;max-height: 250px;">
                                    </div>
                                  @endif
                                  <!-- details -->
                                  @if($value->isSelectionOrder == 1)
                                    <div class="card">
                                      <div class="card-body">
                                        <label>Size:</label>
                                          <span><i>{{ $value->cakeSize }}</i></span><br>
                                        <label>Flavor:</label>
                                          <span><i>{{ $value->cakeFlavor }}</i></span><br>
                                        <label>Filling:</label>
                                          <span><i>{{ $value->cakeFilling }}</i></span><br>
                                        <label>Icing:</label>
                                          <span><i>{{ $value->cakeIcing }}</i></span><br>
                                        <label>Top Border:</label>
                                          <span><i>{{ $value->cakeTopBorder }}</i></span><br>
                                        <label>Bottom Border:</label>
                                          <span><i>{{ $value->cakeBottomBorder }}</i></span><br>
                                        <label>Decoration:</label>
                                          <span><i>{{ $value->cakeDecoration }}</i></span><br>
                                        <label>Message:</label>
                                          <span><i>{{ $value->cakeMessage }}</i></span><br>
                                        <hr>
                                        <div align="right">
                                          <span>&#8369; {{ number_format($value->cakePrice, 2) }}</span>
                                        </div>
                                      </div>
                                    </div>
                                  @endif
                                  @if($value->isSelectionOrder == 2)
                                  <hr>
                                    <label>Info.:</label>
                                    <textarea class="form-control" rows="10" spellcheck="false" style="color:black;" readonly>{{ $value->cakeMessage  }}</textarea>
                                    @if($value->orderStatus == 2)
                                    <hr> 
                                      <label>Details:</label>
                                        <textarea class="form-control" name="invoice_details" rows="10" spellcheck="false" style="color:black;" readonly>{{ $value->invoice_details }}</textarea><br>
                                      <label>Product Price</label>
                                      <input type="text" class="form-control" value="&#8369; {{number_format($value->cakePrice, 2)}}" name="cakePrice" style="color: black;" readonly>
                                    @endif  

                                    @if($value->orderStatus == 3)
                                    <hr> 
                                      <label>Rejection Details:</label>
                                        <textarea class="form-control" name="rejection_details" rows="10" spellcheck="false" style="color:black;" readonly>{{ $value->invoice_details }}</textarea><br>
                                    @endif  

                                  @endif  
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  
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
      <?php echo date('Y');  ?><a href="{{route('terms')}}"> Terms</a> | <a href="{{route('privacy')}}">Privacy</a></span>
    </div>
  </footer>
  <!-- partial -->
</div>