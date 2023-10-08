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
      <!-- partial:dashboard -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Customized Cake Orders</h4>
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th> Action </th>
                          <th> Order No. </th>
                          <th> Image </th>
                          <th> Message </th>
                          <th> Price </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($orders as $key => $value)
                          <tr>
                            <td>
                              @if($value->orderStatus == 1)
                                  <a href="" type="button" style="text-decoration: none;" class="badge badge-outline-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $value->orderID  }}">View</a>
                              @elseif($value->orderStatus == 2)
                                  <button type="button" class="btn badge-outline-success">Approved</button>
                              @elseif($value->orderStatus == 3)
                                  <button type="button" class="btn badge-outline-danger">Rejected</button>
                              @endif
                            </td>
                            <td>{{ $value->orderID  }}</td>
                            <td>
                              @if(!empty($value->cakeOrderImage))
                                <a href="{{ asset($value->cakeOrderImage)  }}">{{ $value->cakeOrderImage  }}</a>
                              @else
                                -
                              @endif
                            </td>
                            <td>{{ $value->cakeMessage  }}</td>
                            <td> &#8369; {{ $value->cakePrice }}</td>
                          </tr>
                          <!-- Modal -->
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
                                          <span>&#8369; {{ $value->cakePrice }}</span>
                                        </div>
                                      </div>
                                    </div>
                                  @endif
                                  @if($value->isSelectionOrder == 2)
                                  <hr>
                                    <label>Additional Info.</label>
                                    <textarea class="form-control" rows="10" spellcheck="false" style="color:black;" readonly>{{ $value->cakeMessage  }}</textarea>
                                  <hr>
                                  @endif
                              <form action="{{ route('approvalOrder', ['id' => $value->orderID]) }}" method="post"> 
                                @csrf
                                  <input type="hidden" value="{{ $value->isSelectionOrder  }}" name="isSelectionOrder">    
                                    @if($value->isSelectionOrder == 2)
                                      <label>Enter Invoice Details</label>
                                      <textarea class="form-control" name="invoice_details" rows="10" spellcheck="false" style="color:white;" required></textarea><br>
                                      <label>Enter Price</label>
                                      <input type="number" class="form-control" name="cakePrice" style="color:white;" required>
                                     @endif
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn badge-outline-success">Approved</button>
                              </form>   
                              <form action="{{ route('rejectOrder', ['id' => $value->orderID]) }}" method="post">
                                @csrf
                                  <button type="submit" class="btn badge-outline-danger">Reject</button>
                              </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
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
  <script src="{{ asset('admin/assets/js/dashboard-orders.js') }}"></script>
</body>

</html>