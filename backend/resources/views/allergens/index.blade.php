@extends('layouts.app')
@section('title', 'アレルギー品目管理')

@section('content')
<h1>アレルギー品目管理</h1>
<a href="/allergens/create" class="btn btn-primary mb-3">アレルギー品目新規作成</a>

@if (session('message'))
<div class="alert alert-danger mt-5">
  <h3>削除に失敗しました</h3>
  <ul>
    <li>{{ session('message') }}</li>
  </ul>
</div>
@endif
<table class="table">
  <tr>
    <th>{{__('validation.attributes.allergen_key')}}</th>
    <th>画像は{キー名.png}で準備してください</th>
    <th>{{__('validation.attributes.lang')}}</th>
    <th>{{__('validation.attributes.allergen_name')}}</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  @foreach ($allergens as $allergen)
    <tr class="colored" data-hash="{{$allergen->hash}}">
      <td>
        {{ $allergen->allergen_key }}
      </td>
      <td>
        <img src="/img/allergens/{{$allergen->allergen_key}}.png">
      </td>
      <td>
        {{ $allergen->lang_jp }}
      </td>
      <td>
        {{ $allergen->allergen_name }}
      </td>
      <td>
        <a href="/allergens/{{$allergen->id}}/edit" class="btn btn-sm btn-primary">編集する</a>
      </td>
      <td>
        @if ($allergen->lang === "ja_JP")
          <form action="/allergens/{{$allergen->id}}/store_by_key" method="post">
            @csrf
            <input type="submit" value="他言語アレルギー品目作成" class="btn btn-sm btn-primary">
          </form>
        @endif
      </td>
      <td>
        <form action="/allergens/{{$allergen->id}}" method="post">
          @csrf
          @method('delete')
          <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
        </form>
      </td>
    </tr>
  @endforeach
</table>
{{ $allergens->appends(request()->input())->links() }}
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