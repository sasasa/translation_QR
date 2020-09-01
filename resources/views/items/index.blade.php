@extends('layouts.app')
@section('title', 'メニューアイテム管理')

@section('content')
<h1>メニューアイテム管理</h1>
<a href="/items/create" class="btn btn-primary mb-3">メニューアイテム新規登録</a>
<table class="table">
  @foreach ($items as $item)
  <tr>
    <th>{{__('validation.attributes.item_key')}}</th>
    <td>{{$item->item_key}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.lang')}}</th>
    <td>{{$item->lang_jp}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.item_name')}}</th>
    <td><a href="/items/{{$item->id}}/edit">{{$item->item_name}}</a></td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.item_price')}}</th>
    <td>{{$item->item_price}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.item_order')}}</th>
    <td>{{$item->item_order}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.item_desc')}}</th>
    <td>{{$item->item_desc}}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.image_path')}}</th>
    <td>
      {{$item->image_path}}
      <img src="/storage/{{$item->image_path}}">
    </td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.genre_id')}}</th>
    <td>{{$item->genre->genre_name}}({{$item->genre->genre_key}})</td>
  </tr>
  <tr>
    <th></th>
    <td>
      <form action="/items/{{$item->id}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
      </form>
    </td>
  </tr>
  @endforeach
</table>
{{ $items->appends(request()->input())->links() }}
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
});
</script>
@endsection