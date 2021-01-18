@extends('layouts.app')
@section('title', '座席管理')

@section('content')
<h1>座席管理</h1>
<a href="/seats/create" class="btn btn-primary mb-3">座席新規作成</a>

@if (session('message'))
<div class="alert alert-danger mt-5">
  <h3>QRコード再生成に失敗しました</h3>
  <ul>
    <li>{{ session('message') }}</li>
  </ul>
</div>
@endif
<table class="table">
  @foreach ($seats as $seat)
  <tr>
    <th>{{__('validation.attributes.seat_name')}}</th>
    <td><a href="/seats/{{$seat->id}}/edit">{{$seat->seat_name}}</a></td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.how_many')}}</th>
    <td>{{$seat->how_many}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.seat_state')}}</th>
    <td>{{$seat->state_jp}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.seat_hash')}}</th>
    <td>{{$seat->seat_hash}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.qr_code')}}</th>
    <td>
      <a href="/qr_code/{{$seat->id}}">
        <img src="/qr_code/{{$seat->id}}">
      </a>
    </td>
  </tr>
  <tr>
    <th></th>
    <td class="d-flex">
      <form action="/seats/{{$seat->id}}/rehash" method="post">
        @csrf
        @method('PATCH')
        <input type="submit" value="QRコードを再生成" class="btn btn-sm btn-danger btn-rehash">
      </form>
      <a href="/seats/{{$seat->id}}/print" class="btn btn-sm btn-primary ml-2" target="_blank">QRコードを印刷</a>
    </td>
  </tr>
  <tr>
    <th></th>
    <td>
      <form action="/seats/{{$seat->id}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
      </form>
    </td>
  </tr>
  <tr>
    <th></th>
    <td></td>
  </tr>
  @endforeach
</table>
{{ $seats->appends(request()->input())->links() }}
@endsection

@section('script')
<script type="module">
$(function(){
    $(".btn-del").click(function() {
        if(confirm("本当に削除してもよろしいですか？")) {
        } else {
            //cancel
            event.preventDefault();
            return false;
        }
    });
    $(".btn-rehash").click(function() {
        if(confirm("本当にQRコードを再生成してもよろしいですか？再印刷が必要になります。")) {
        } else {
            //cancel
            event.preventDefault();
            return false;
        }
    });
});
</script>
@endsection