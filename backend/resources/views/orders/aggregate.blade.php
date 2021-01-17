@extends('layouts.app')
@section('title', '人気商品確認')

@section('content')
<h1>人気商品確認</h1>
<form action="/aggregate" method="get" class="get-form form mb-2">
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
  <form action="/aggregate" method="get" class="form mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$yesterday}}">
    <input type="hidden" name="search_end_at" value="{{$today}}">
    <input type="submit" value="昨日" class="btn btn-primary">
  </form>
  <form action="/aggregate" method="get" class="form mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$today}}">
    <input type="hidden" name="search_end_at" value="{{$tomorrow}}">
    <input type="submit" value="今日" class="btn btn-primary">
  </form>
  <form action="/aggregate" method="get" class="form mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$lastOfWeek}}">
    <input type="hidden" name="search_end_at" value="{{$startOfWeek}}">
    <input type="submit" value="先週" class="btn btn-primary">
  </form>
  <form action="/aggregate" method="get" class="form mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$startOfWeek}}">
    <input type="hidden" name="search_end_at" value="{{$nextOfWeek}}">
    <input type="submit" value="今週" class="btn btn-primary">
  </form>
  <form action="/aggregate" method="get" class="form mb-2 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$lastOfMonth}}">
    <input type="hidden" name="search_end_at" value="{{$startOfMonth}}">
    <input type="submit" value="先月" class="btn btn-primary">
  </form>
  <form action="/aggregate" method="get" class="form mb-5 mr-2">
    @csrf
    <input type="hidden" name="search_start_at" value="{{$startOfMonth}}">
    <input type="hidden" name="search_end_at" value="{{$nextOfMonth}}">
    <input type="submit" value="今月" class="btn btn-primary">
  </form>
</div>

<table class="table">
  <tr>
    <th>
      商品キー
    </th>
    <th>
      商品日本語
    </th>
    <th>
      {{Form::select('',  [
        'quantity' => '売り上げ個数',
        'sales' => '売り上げ額',
      ], $aggregate, ['id'=>'aggregate', 'class'=>'form-control'])}}
    </th>
  </tr>

  @foreach ($orders as $key => $val)
    <tr>
        <td>
          {{ $key }}
        </td>
        <td>
          {{ \App\Item::whereItemKey($key) ? \App\Item::whereItemKey($key)->item_name : '削除されたメニュー' }}
        </td>
        <td>
          {{ number_format($val) }}
        </td>
    </tr>
  @endforeach
  @foreach ($items->diff($orders->keys()) as $key)
    <tr>
        <td>
          {{ $key }}
        </td>
        <td>
          {{ \App\Item::whereItemKey($key) ? \App\Item::whereItemKey($key)->item_name : '削除されたメニュー' }}
        </td>
        <td>
          {{ 0 }}
        </td>
    </tr>
  @endforeach
</table>
@endsection

@section('script')
<script type="module">
  $(function(){
    $(".form").submit(function() {
      let hiddenTag = $('<input>').attr({
        type: 'hidden',
        name: 'aggregate',
        value: $('#aggregate').val()
      })
      $(this).prepend(hiddenTag)
    })
    $('#aggregate').change(function() {
      $('.get-form').submit()
    })
  })
</script>
@endsection