@extends('layouts.app')
@section('title', "タイトル")
@section('description', "デスクリプション")

@section('content')
<div>
  <a href="/ja/items">日本語</a>
  <a href="/en/items">English</a>
  <a href="/zh/items">中文</a>
  <a href="/ko/items">한글</a>
</div>

<div>
@foreach ($genres as $genre)
  <a href="/{{$lang}}/{{$genre->genre_key}}/items">{{$genre->genre_name}}</a>
@endforeach
</div>

<table class="table">
  @foreach ($items as $item)
    <tr>
      <th>{{__('validation.attributes.lang')}}</th>
      <td>
          {{ $item->lang }}
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
      <th>{{__('validation.attributes.image_path')}}</th>
      <td>{{ $item->image_path }}</td>
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
