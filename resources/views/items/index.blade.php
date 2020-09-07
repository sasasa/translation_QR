@extends('layouts.app')
@section('title', 'メニューアイテム管理')

@section('content')
<h1>メニューアイテム管理</h1>
<a href="/items/create" class="btn btn-primary mb-3">メニューアイテム新規登録</a>
<table class="table">
  @foreach ($items as $item)
  <tbody class="colored" data-hash="{{$item->hash}}">
  <tr>
    <th>{{__('validation.attributes.image_path')}}</th>
    <td>
      <img src="/storage/{{$item->image_path}}">
    </td>
  </tr>
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
    <td>{{$item->item_name}}</td>
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
    <th>{{__('validation.attributes.genre_id')}}</th>
    <td>{{$item->genre->genre_name}}({{$item->genre->genre_key}})</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.allergen_name')}}</th>
    <td>
      @foreach ($item->allergens as $allergen)
        <span>
          {{$allergen->allergen_name}}
          @if ($allergen->lang !== "ja_JP")
            ({{$allergen->name_jp}})
          @endif
          <img src="/img/allergens/{{$allergen->allergen_key}}.png">
        </span>
      @endforeach
    </td>
  </tr>
  <tr>
    <th></th>
    <td>
      <a href="/items/{{$item->id}}/edit" class="btn btn-sm btn-primary mb-2">編集する</a>
      <form action="/items/{{$item->id}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
      </form>
    </td>
  </tr>
  </tbody>
  @endforeach
</table>
{{ $items->appends(request()->input())->links() }}
@endsection

@section('script')
<script type="module">
$(function(){
    colorize()

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