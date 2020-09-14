@extends('layouts.print')
@section('title', $seatSession->seat->seat_name. 'の明細')

@section('content')
<div class="print_page">
  <h1>{{$seatSession->seat->seat_name. 'の明細'}}</h1>
  <div>{{$now}}</div>
  <div class="h1">{{$all_items}}点{{$all_price}}円</div>
  <ul>
      @foreach ($ordered_orders as $order)
      <li>
        {{$order->item_jp->item_name}}(ID{{$order->id}}){{$order->is_take_out ? "テイクアウト" : ""}}
        ---{{$order->tax_included_price}}円
      </li>
      @endforeach
  </ul>
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