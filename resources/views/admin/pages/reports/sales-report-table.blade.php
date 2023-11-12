@php
// Assuming you have a $orders variable containing the order data retrieved from the database
$count = 1;
@endphp
@foreach ($allOrders as $order)
<tr>
  <td>{{ $count++ }}</td>
  <td>{{ $order->order_id }}</td>
  <td>{{ $order->type }}</td>
  @if($order->payment_option)
  <td>{{ $order->payment_option }}</td>
  @else <td>Full</td>
  @endif
  <td>{{ $order->order_status }}</td>
  <td>{{ $order->payment_status }}</td>
  <td>Php {{ number_format($order->total_price, 2) }}</td>
  <td>Php {{ number_format($order->total_price - $order->payment_balance, 2) }}</td>
  @if($order->payment_balance)
  <td>Php {{ number_format($order->payment_balance, 2) }}</td>
  @else <td> - </td>
  @endif
  <td>{{ $order->created_at->format('d M Y') }}</td>
</tr>
@endforeach
