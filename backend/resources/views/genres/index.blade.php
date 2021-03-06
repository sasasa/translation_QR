@extends('layouts.app')
@section('title', 'ジャンル管理')

@section('content')
<h1>ジャンル管理</h1>
<a href="/genres/create" class="btn btn-primary mb-3">ジャンル新規作成</a>

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
    <th>{{__('validation.attributes.genre_key')}}</th>
    <th>{{__('validation.attributes.lang')}}</th>
    <th>{{__('validation.attributes.genre_name')}}</th>
    <th>{{__('validation.attributes.genre_order')}}</th>
    <th>{{__('validation.attributes.parent_id')}}</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  @foreach ($genres as $genre)
    <tr class="colored" data-hash="{{$genre->hash}}">
      <td>
        {{ $genre->genre_key }}
      </td>
      <td>
        {{ $genre->lang_jp }}
      </td>
      <td>
        {{ $genre->genre_name }}
      </td>
      <td>
        {{ $genre->genre_order }}
      </td>
      <td>
        {{ $genre->parent ? $genre->parent->genre_name. '('. $genre->parent->genre_key .')【'.$genre->parent->lang_jp.'】' : '無し'}}
      </td>
      <td>
        <a href="/genres/{{$genre->id}}/edit" class="btn btn-sm btn-primary">編集する</a>
      </td>
      <td>
        @if ($genre->lang === "ja_JP")
          <form action="/genres/{{$genre->id}}/store_by_key" method="post">
            @csrf
            <input type="submit" value="他言語ジャンル作成" class="btn btn-sm btn-primary">
          </form>
        @endif
      </td>
      <td>
        <form action="/genres/{{$genre->id}}" method="post">
          @csrf
          @method('delete')
          <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
        </form>
      </td>
    </tr>
  @endforeach
</table>
{{ $genres->appends(request()->input())->links() }}
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