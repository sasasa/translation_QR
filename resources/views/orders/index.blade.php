@extends('layouts.app')
@section('title', '注文確認')

@section('content')


<view-order-component>
</view-order-component>

{{-- <h1>注文確認</h1>

<table class="table">
  @foreach ($orders as $order)
  <tr>
    <th>{{$order->item->item_name}}</th>
    <td>{{$order->seatSession->seat->seat_name}}</td>
  </tr>
  @endforeach
</table> --}}

@endsection