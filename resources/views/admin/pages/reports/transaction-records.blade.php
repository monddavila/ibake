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
                            <h4 class="card-title">Payment Transactions</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <p>E-wallets Payments:</p>
                                <strong>Php {{ number_format($totalEwallets, 2)}}</strong>
                            </div>
                            <div class="col-lg-3">
                                <p>Cards Payments:</p>
                                <strong>Php {{ number_format($totalCards, 2) }}</strong>
                            </div>
                            <div class="col-lg-3">
                                <p>Direct Online Banking Payments:</p>
                                <strong>Php {{ number_format($totalBank, 2) }}</strong>
                            </div>
                            <div class="col-lg-3">
                                <p>Cash Payments:</p>
                                <strong>Php {{ number_format($totalCash, 2) }}</strong>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3">
                                <p>Payments on Account:</p>
                                <strong>Php {{ number_format($totalOnhand, 2) }}</strong>
                            </div>
                            <div class="col-lg-3">
                                <p>Receivables:</p>
                                <strong>Php {{ number_format($totalReceivables, 2) }}</strong>
                            </div>
                            <div class="col-lg-3">
                                <p>Total Sales:</p>
                                <strong>Php {{ number_format($totalSales, 2) }}</strong>
                            </div>
                        </div>
                    </div>

              </div>
            </div>
          </div>

          <div class="row ">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h4 class="card-title">Products Sold</h4>
                  <a href="" class="btn btn-success me-2">
                      <i class="fas fa-download"></i> Export
                  </a>
                  </div>
                  <div class="table-responsive">
                        <table class="table" id="products-table">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Image </th>
                                    <th> Name </th>
                                    <th> Category </th>
                                    <th> Price </th>
                                    <th> Qty Sold </th>
                                    <th> Total Amount </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sellingProducts as $product)
                                <tr>
                                    <td>{{ $product->product_id }}</td>
                                    <td><img src="{{ asset($product->product->image) }}"></td>
                                    <td>{{ $product->product->name }}</td>
                                    <td>{{ $product->product->category->name }}</td>
                                    <td>₱ {{ number_format($product->product->price, 2) }}</td>
                                    <td>{{ $product->total_quantity }}</td>
                                    <td>₱ {{ number_format($product->product->price * $product->total_quantity, 2) }}</td>
                                </tr>
                                @endforeach

                                </tbody>
                      </table>
                  </div>
                  {{ $sellingProducts->links() }} <!-- Custom Cake Orders Pagination Links -->
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
  </div>



  <!-- plugins:js -->

  @include('admin.partials.script')
  <script src="{{ asset('admin/assets/js/admin-orders.js') }}"></script>
  <!-- JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  


</body>

</html>