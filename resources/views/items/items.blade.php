@extends('layouts.app')
@section('title', "タイトル")
@section('description', "デスクリプション")

@section('content')
<div id="app">
  <example-component></example-component>
</div>

<div>
  <a href="/ja/{{$current_genre}}/items">日本語</a>
  <a href="/en/{{$current_genre}}/items">English</a>
  <a href="/zh/{{$current_genre}}/items">中文</a>
  <a href="/ko/{{$current_genre}}/items">한글</a>
</div>

@foreach ($genres as $genre)
<div>
  <a href="/{{$lang}}/{{$genre->genre_key}}/items">{{$genre->genre_name}}</a>
  <ul>
  @foreach ($genre->children as $child_genre)
    <li>
      <a href="/{{$lang}}/{{$child_genre->genre_key}}/items">{{$child_genre->genre_name}}</a>
    </li>
  @endforeach
  </ul>
</div>
@endforeach

<table class="table">
  @foreach ($items as $item)
  <tr>
    <th>{{__('validation.attributes.image_path')}}</th>
    <td>
      {{ $item->image_path }}
      <img src="/storage/{{$item->image_path}}">
    </td>
  </tr>
    <tr>
      <th>{{__('validation.attributes.lang')}}</th>
      <td>
          {{ $item->lang_jp }}
      </td>
    </tr>
    <tr>
      <th>{{__('validation.attributes.item_name')}}</th>
      <td>{{ $item->item_name }}</td>
    </tr>
    <tr>
      <th>{{__('validation.attributes.item_key')}}</th>
      <td>{{ $item->item_key }}</td>
    </tr>
    <tr>
      <th>{{__('validation.attributes.item_desc')}}</th>
      <td>{{ $item->item_desc }}</td>
    </tr>
    <tr>
      <th>{{__('validation.attributes.item_price')}}</th>
      <td>{{ $item->item_price }}</td>
    </tr>
    <tr>
      <th>{{__('validation.attributes.genre')}}</th>
      <td>{{ $item->genre->genre_name }}</td>
    </tr>
    @endforeach
  </table>

@endsection
