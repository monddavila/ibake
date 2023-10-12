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
                  <h4 class="card-title">Customized Cake Order Requests</h4>
                  <div class="table-responsive">
                    <table class="table" id="orders-table">
                      <thead>
                        <tr>
                          <th> Action </th>
                          <th> Order No. </th>
                          <th> Request Date </th>
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
                                  <a href="" type="button" style="text-decoration: none;" class="badge badge-outline-success btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $value->orderID  }}">View Request</a>
                              @elseif($value->orderStatus == 2)
                                  <button type="button" class="btn badge-outline-success">Approved</button>
                              @elseif($value->orderStatus == 3)
                                  <button type="button" class="btn badge-outline-danger">Rejected</button>
                                  @elseif($value->orderStatus == 4)
                                  <div class="badge badge-outline-warning">Pocessed</div>
                              @endif
                            </td>
                            <td>
                                @if ($value->orderStatus == 4)
                                    <!-- Common content when the condition is met -->
                                    <span>{{ $value->orderID }}</span>
                                @else
                                    <!-- Content for the modal when the condition is not met -->
                                    <a href="#" style="text-decoration: none; color: yellow;" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $value->orderID }}">
                                        {{ $value->orderID }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('d M Y') : 'N/A' }}
                            </td>
                            <td>
                              @if(!empty($value->cakeOrderImage))
                                <a href="{{ asset($value->cakeOrderImage)  }}">{{ $value->cakeOrderImage  }}</a>
                              @else
                                -
                              @endif
                            </td>
                            <td>{{ $value->cakeMessage  }}</td>
                            <td> &#8369; {{ number_format($value->cakePrice, 2) }}</td>
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
                                        <label>Cake Message:</label>
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
                                    <label>Additional Info.</label>
                                    <textarea class="form-control" rows="10" spellcheck="false" style="color:black;" readonly>{{ $value->cakeMessage  }}</textarea>
                                  <hr>
                                  @endif
                                  <form action="{{ route('processOrder', ['id' => $value->orderID]) }}" method="post"> 
                                      @csrf
                                      <input type="hidden" value="{{ $value->isSelectionOrder }}" name="isSelectionOrder">
                                      
                                      @if($value->isSelectionOrder == 2)
                                      <label>Enter Details/Remarks</label>
                                      <textarea class="form-control" name="invoice_details" rows="10" spellcheck="false" style="color:white;" required></textarea><br>
                                      <label>Enter Price (Enter 0 for rejected order)</label>
                                      <input type="number" class="form-control" name="cakePrice" style="color:white;" required>
                                      @endif
                                      
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn badge-outline-success approve-button" name="action" value="approve">Approved</button>
                                          <button type="submit" class="btn badge-outline-danger cancel-button" name="action" value="reject">Reject</button>
                                      </div>
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
  <script>
    document.querySelectorAll(".cancel-button").forEach(function(button) {
    button.addEventListener("click", function (event) {
        if (!confirm("Are you sure you want to reject this order? The order will be declined.")) {
            event.preventDefault(); 
        }
    });
    });
  </script>

<script>
    document.querySelectorAll(".approve-button").forEach(function(button) {
    button.addEventListener("click", function (event) {
        if (!confirm("Are you sure you want to approve this order? Order will be transferred to active order queue list.")) {
            event.preventDefault(); 
        }
    });
    });
  </script>

  @include('admin.partials.script')

</body>

</html>