@extends('layouts.print')
@section('title', $seatSession->seat->seat_name. 'の明細')

@section('content')
<div class="print_page">
  <h1>{{$seatSession->seat->seat_name. '席明細'}}</h1>
  <div>{{$now}}</div>
  <div class="h1">{{$all_items}}点{{$all_price}}円</div>
      @foreach ($ordered_orders as $is_take_out => $take_out_orders)
      <div>
        @if ($is_take_out)
          テイクアウト
        @else
          店内飲食
        @endif
        <ul>
        @foreach ($take_out_orders as $item_name => $orders)
          <li>
          {{$item_name}}---
          {{$orders->count()}}<br>
          {{$orders->map(function($order){ return $order->tax_included_price;})->sum()}}円
          </li>
        @endforeach
        </ul>
      </div>
      @endforeach
</div>
@endsection

@section('script')
<script type="module">
$(function(){
  setTimeout(function(){
    window.print()
    window.close()
  }, 100)
})
</script>
@endsection