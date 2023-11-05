<div class="main-panel">
  <div class="content-wrapper">

  <div class="row">
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Remaining Inventory</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">₱ {{ number_format($totalInventoryValue, 2) }}</h2>
                  
                </div>
                <h6 class="text-muted font-weight-normal">Current Actual Inventory</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
              <i class="icon-lg mdi mdi-package-variant-closed text-primary ms-auto"></i>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Payments Received</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">₱ {{ number_format($paymentsReceived, 2) }}</h2>
                  {{--<p class="text-success ms-2 mb-0 font-weight-medium">+8.3%</p>--}} 
                </div>
                <h6 class="text-muted font-weight-normal">YTD On-hand Revenue</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
              <i class="icon-lg mdi mdi-cash-register text-danger ms-auto"></i>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Receivables</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">₱ {{ number_format($customPaymentsReceivedHalf, 2) }}</h2>
                  {{--<p class="text-danger ms-2 mb-0 font-weight-medium">-2.1% </p>--}}
                </div>
                <h6 class="text-muted font-weight-normal">Actual Payment Receivables</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-cash text-success ms-auto"></i>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Total Sales</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">₱ {{ number_format($totalSales, 2) }}</h2>
                  {{--<p class="text-danger ms-2 mb-0 font-weight-medium">-2.1% </p>--}}
                </div>
                <h6 class="text-muted font-weight-normal">YTD Sales of all Products</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-store text-warning ms-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    @include('admin.pages.dashboard.dashboard-orders')

    <div class="row">
    <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9 d-flex align-items-center justify-content-center">
                  <div class="d-flex align-items-center">
                      <h3 class="mb-0">{{ $customOrderRequests }}</h3>
                  </div>
              </div>
              <div class="col-3">
                <a href="/orders/customize-order-section">
                  <div class="icon icon-box-dark">
                      <span class="mdi mdi-note icon-item"></span>
                  </div>
                </a>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal text-center">Custom Order Requests</h6>
          </div>
        </div>
      </div>
    <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9 d-flex align-items-center justify-content-center">
                  <div class="d-flex align-items-center">
                      <h3 class="mb-0">{{$pendingOrders}}</h3>
                  </div>
              </div>
              <div class="col-3">
                <a href="/orders/active">
                  <div class="icon icon-box-warning ">
                  <span class="mdi mdi-timer-sand icon-item"></span>
                  </div>
                </a>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal text-center">Pending Orders</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9 d-flex align-items-center justify-content-center">
                  <div class="d-flex align-items-center">
                      <h3 class="mb-0">{{$processingOrders}}</h3>
                  </div>
              </div>
              <div class="col-3">
                <a href="/orders/ongoing">
                  <div class="icon icon-box-info">
                    <span class="mdi mdi-cupcake icon-item"></span>
                  </div>
                </a>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal text-center">Processing Orders</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9 d-flex align-items-center justify-content-center">
                  <div class="d-flex align-items-center">
                      <h3 class="mb-0">{{$readyOrders}}</h3>
                  </div>
              </div>
              <div class="col-3">
                <a href="/orders/ready">
                  <div class="icon icon-box-primary">
                    <span class="mdi mdi-truck-fast icon-item"></span>
                  </div>
                </a>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal text-center">Dispatched Orders</h6>
          </div>
        </div>
      </div>
      
      <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9 d-flex align-items-center justify-content-center">
                  <div class="d-flex align-items-center">
                      <h3 class="mb-0">{{$completedOrders}}</h3>
                  </div>
              </div>
              <div class="col-3">
                <a href="/orders/completed">
                  <div class="icon icon-box-success">
                    <span class="mdi mdi-check-circle icon-item"></span>
                  </div>
                </a>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal text-center">Completed Orders</h6>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9 d-flex align-items-center justify-content-center">
                  <div class="d-flex align-items-center">
                      <h3 class="mb-0">{{$cancelledOrders}}</h3>
                  </div>
              </div>
              <div class="col-3">
                <a href="/orders/cancelled">
                  <div class="icon icon-box-danger ">
                    <span class="mdi mdi-close-circle icon-item"></span>
                  </div>
                </a>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal text-center">Cancelled Orders</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Payment Transactions</h4>

            <canvas id="transaction-history" data-chart-data="{{ json_encode($dynamicData) }}" class="transaction-chart"></canvas>
            
            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
              <div class="text-md-center text-xl-left">
                <h6 class="mb-1">E-wallets</h6>
                <p class="text-muted mb-0">Gcash & Maya E-wallet payments</p>
              </div>
              <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0">₱{{number_format($totalEwallets, 2)}}</h6>
              </div>
            </div>
            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
              <div class="text-md-center text-xl-left">
                <h6 class="mb-1">Debit/Credit Cards</h6>
                <p class="text-muted mb-0">Gcash & Maya E-wallet payments</p>
              </div>
              <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0">₱{{number_format($totalCards, 2)}}</h6>
              </div>
            </div>
            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
              <div class="text-md-center text-xl-left">
                <h6 class="mb-1">Online Banking</h6>
                <p class="text-muted mb-0">BPI online banking transactions</p>
              </div>
              <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0">₱{{number_format($totalBank, 2)}}</h6>
              </div>
            </div>
            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
              <div class="text-md-center text-xl-left">
                <h6 class="mb-1">Cash</h6>
                <p class="text-muted mb-0">Payments upon delivery or pickup</p>
              </div>
              <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0">₱{{number_format($totalCash, 2)}}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
              <h4 class="card-title mb-1">Best Selling Products</h4>
              
            </div>
            <div class="row">
              <div class="col-12">
                <div class="preview-list">
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Registered Users</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$RegisteredUsers}}</h2>
                  {{--<p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>--}}
                </div>
                <h6 class="text-muted font-weight-normal">Users with Registered Account</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <a href="/user/list">
                <i class="icon-lg mdi mdi-account-check text-dark ms-auto"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-2 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Customers</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$RegisteredCustomers}}</h2>
                  {{--<p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>--}}
                </div>
                <h6 class="text-muted font-weight-normal">Registered Customers</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <a href="/user/list">
                <i class="icon-lg mdi mdi-account-circle text-warning ms-auto"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-2 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Products</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$products}}</h2>
                  {{--<p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>--}}
                </div>
                <h6 class="text-muted font-weight-normal">Total no. of listed Products</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <a href="/products/list">
                  <i class="icon-lg mdi mdi-cupcake text-info ms-auto"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-2 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Categories</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$categories}}</h2>
                  {{--<p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>--}}
                </div>
                <h6 class="text-muted font-weight-normal">Total no. of Product Categories</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <a href="/products/categories">
                  <i class="icon-lg mdi mdi-codepen text-primary ms-auto"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-2 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Tags</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$tags}}</h2>
                  {{--<p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>--}}
                </div>
                <h6 class="text-muted font-weight-normal">Total no. of Product Tags</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <a href="/products/tags">
                <i class="icon-lg mdi mdi-tag text-success ms-auto"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-2 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5>Reviews</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$totalReviewCount}}</h2>
                  {{--<p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>--}}
                </div>
                <h6 class="text-muted font-weight-normal">Total no. of Product & Custom Cake Reviews</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <a href="/reports/reviews">
                  <i class="icon-lg mdi mdi-note text-danger ms-auto"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-6 col-xl-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
              <h4 class="card-title">Recent Product Reviews</h4>
              <a href="{{ route('viewReview')}}" class="text-muted mb-1 small">View all</a>
            </div>
            <div class="preview-list">

              @foreach($reviews as $review)
              <div class="preview-item border-bottom">
                <div class="preview-thumbnail">
                  <img src="admin/assets/images/faces/face.jpg" alt="image" class="rounded-circle" />
                </div>
                <div class="preview-item-content d-flex flex-grow">
                  <div class="flex-grow">
                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                      <h6 class="preview-subject">{{$review->user->firstname}} {{$review->user->lastname}}</h6>
                      <p class="text-muted text-small">{{$review->created_at}}</p>
                    </div>
                    <p class="text-muted">Product: {{$review->product->name}}</p>
                    <p class="text-muted">Rating: {{$review->rating}}</p>
                    <p class="text-muted">{{$review->comment}}</p>
                  </div>
                </div>
              </div>
              @endforeach
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xl-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
              <h4 class="card-title">Recent Custom Cake Reviews</h4>
              <a href="{{ route('viewCustomReviews')}}" class="text-muted mb-1 small">View all</a>
            </div>
            <div class="preview-list">
              
              @foreach($customReviews as $review)
                <div class="preview-item border-bottom">
                  <div class="preview-thumbnail">
                    <img src="admin/assets/images/faces/face.jpg" alt="image" class="rounded-circle" />
                  </div>
                  <div class="preview-item-content d-flex flex-grow">
                    <div class="flex-grow">
                      <div class="d-flex d-md-block d-xl-flex justify-content-between">
                        <h6 class="preview-subject">{{$review->user->firstname}} {{$review->user->lastname}}</h6>
                        <p class="text-muted text-small">{{$review->created_at}}</p>
                      </div>
                      <p class="text-muted">Order ID: {{$review->order_id}}</p>
                      <p class="text-muted">Rating: {{$review->rating}}</p>
                      <p class="text-muted">{{$review->comment}}</p>
                    </div>
                  </div>
                </div>
                @endforeach

            </div>
          </div>
        </div>
      </div>
      
    
    </div>

  </div>

  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © iBake Tiers of Joy
        2023</span>
    </div>
  </footer>
  <!-- partial -->
</div>