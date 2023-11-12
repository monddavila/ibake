@php
// Assuming you have a $orders variable containing the order data retrieved from the database
$count = 1;
@endphp
@foreach ($allOrders as $order)
<tr>
  <td>{{ $count++ }}</td>
  <td>{{ $order->name }}</td>
  <td>{{ $order->type }}</td>
  <td>{{ $order->order_id }}</td>
  <td>Php {{ number_format($order->total_price, 2) }}</td>
  <td>{{ $order->shipping_method }}</td>
  <td>{{ $order->created_at->format('d M Y') }}</td>
  <td>{{ $order->delivery_date}}  </td>
  <td>{{ $order->updated_at->format('d M Y') }}</td>
</tr>
@endforeach
