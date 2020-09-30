@extends('layouts.app')
@section('title', '売上確認')

@section('content')
<h1>売上確認</h1>
<form action="/sum_total" method="get" class="mb-2">
  @csrf
  <div class="form-group">
    <label for="search_start_at">検索開始日時(&gt;=):</label>
    <input type="datetime-local" id="search_start_at" name="search_start_at" value="{{$search_start_at}}" class="form-control">
  </div>
  <div class="form-group">
    <label for="search_end_at">検索終了日時(&lt;):</label>
    <input type="datetime-local" id="search_end_at" name="search_end_at" value="{{$search_end_at}}" class="form-control">
  </div>
  <input type="submit" value="検索" class="btn btn-primary">
</form>
<div class="d-flex">
  <form action="/sum_total" method="get" class="mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$yesterday}}">
    <input type="hidden" name="search_end_at" value="{{$today}}">
    <input type="submit" value="昨日" class="btn btn-primary">
  </form>
  <form action="/sum_total" method="get" class="mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$today}}">
    <input type="hidden" name="search_end_at" value="{{$tomorrow}}">
    <input type="submit" value="今日" class="btn btn-primary">
  </form>
  <form action="/sum_total" method="get" class="mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$lastOfWeek}}">
    <input type="hidden" name="search_end_at" value="{{$startOfWeek}}">
    <input type="submit" value="先週" class="btn btn-primary">
  </form>
  <form action="/sum_total" method="get" class="mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$startOfWeek}}">
    <input type="hidden" name="search_end_at" value="{{$nextOfWeek}}">
    <input type="submit" value="今週" class="btn btn-primary">
  </form>
  <form action="/sum_total" method="get" class="mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$lastOfMonth}}">
    <input type="hidden" name="search_end_at" value="{{$startOfMonth}}">
    <input type="submit" value="先月" class="btn btn-primary">
  </form>
  <form action="/sum_total" method="get" class="mb-5 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$startOfMonth}}">
    <input type="hidden" name="search_end_at" value="{{$nextOfMonth}}">
    <input type="submit" value="今月" class="btn btn-primary">
  </form>
</div>

<h2>
  売上げ計(税込み):{{number_format($sum_sales)}}円
</h2>
<h2>
  支払い数:{{number_format($count)}}回
</h2>
<table class="table">
  <tr>
    <th>
      ID
    </th>
    <th>
      売り上げ(税込み)
    </th>
    <th>
      売り上げ日時
    </th>
  </tr>
  @foreach ($payments as $payment)
    <tr>
        <td>
          {{ $payment->id }}
        </td>
        <td>
          {{ number_format($payment->tax_included_price) }}円
        </td>
        <td>
          {{ $payment->created_at }}
        </td>
    </tr>
  @endforeach
</table>
{{ $payments->appends(request()->input())->links() }}

@endsection