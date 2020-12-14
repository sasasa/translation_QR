@extends('layouts.app')
@section('title', 'メニュー管理')

@section('content')
<h1>メニュー管理</h1>
<form action="/items" method="get" class="mb-5">
  @csrf
  <div class="form-group">
    <label for="item_key">{{__('validation.attributes.item_key')}}:</label>
    <input type="text" id="item_key" name="item_key" value="{{$item_key}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="item_name">{{__('validation.attributes.item_name')}}:</label>
    <input type="text" id="item_name" name="item_name" value="{{$item_name}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="genre_key">{{__('validation.attributes.genre_key')}}:</label>
    {{ Form::select('genre_key', \App\Genre::optionsForGenreKey(), $genre_key, ['class'=>"form-control", 'id'=>'genre_key']) }}
  </div>

  <div class="form-group">
    <label for="lang">{{__('validation.attributes.lang')}}:</label>
    {{ Form::select('lang', \App\Item::$selectKeys, $lang, ['class'=>"form-control", 'id'=>'lang']) }}
  </div>

  <input type="submit" value="検索" class="btn btn-primary">
</form>

<a href="/items/create" class="btn btn-primary mb-3">メニュー新規作成</a>
<table class="table">
  @foreach ($items as $item)
  <tbody class="colored" data-hash="{{$item->hash}}">
  <tr>
    <th>{{__('validation.attributes.image_path')}}</th>
    <td>
      <img src="/storage/{{$item->image_path}}?{{ str_random(8) }}">
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
    <td>{{$item->genre && $item->genre->genre_name}}({{$item->genre && $item->genre->genre_key}})</td>
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
      @if ($item->lang === 'ja_JP')
      <a href="/items/create_by_key/{{$item->id}}" class="btn btn-sm btn-primary mb-2">他言語メニュー作成</a>
      <form action="/items/out_of_stock/{{$item->id}}" method="post">
        @csrf
        @method('patch')
        @if ($item->is_out_of_stock)
          <input type="submit" value="販売開始する(全ての言語)" class="btn btn-sm btn-danger mb-2">
        @else
          <input type="submit" value="品切れにする(全ての言語)" class="btn btn-sm btn-danger mb-2">
        @endif
      </form>
      @endif

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