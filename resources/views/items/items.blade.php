@extends('layouts.app')
@section('title', "タイトル")
@section('description', "デスクリプション")

@section('content')

<div id="app">
  <menu-component
    current_genre="{{$current_genre}}"
    lang="{{$lang}}"
  ></menu-component>
</div>

@endsection
