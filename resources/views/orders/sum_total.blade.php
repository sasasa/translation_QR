@extends('layouts.app')
@section('title', '売上確認')

@section('content')
<h1>売上確認</h1>
<form action="/sum_total" method="get" class="mb-5">
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

<h2>
  売上げ:{{$sum_sales}}円
</h2>
<h2>
  支払い数:{{$count}}回
</h2>
<table class="table">
  <tr>
    <th></th>
    <th></th>
  </tr>
  @foreach ($payments as $payment)
    <tr>
      <td>
        {{ $payment->tax_included_price }}円
      </td>
      <td>
        {{ $payment->updated_at }}
      </td>
    </tr>
  @endforeach
</table>
{{ $payments->appends(request()->input())->links() }}

@endsection