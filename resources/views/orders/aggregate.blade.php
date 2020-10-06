@extends('layouts.app')
@section('title', '人気商品確認')

@section('content')
<h1>人気商品確認</h1>

<table class="table">
  <tr>
    <th>
      商品キー
    </th>
    <th>
      商品日本語
    </th>
    <th>
      売り上げ個数
    </th>
  </tr>

  @foreach ($orders as $key => $val)
    <tr>
        <td>
          {{ $key }}
        </td>
        <td>
          {{ \App\Item::whereItemKey($key)->item_name }}
        </td>
        <td>
          {{ $val }}
        </td>
    </tr>
  @endforeach
  @foreach ($items->diff($orders->keys()) as $key)
    <tr>
        <td>
          {{ $key }}
        </td>
        <td>
          {{ \App\Item::whereItemKey($key)->item_name }}
        </td>
        <td>
          {{ 0 }}
        </td>
    </tr>
  @endforeach
</table>
@endsection