@extends('layouts.app')
@section('title', "タイトル")
@section('description', "デスクリプション")

@section('content')

<div id="app">
  <router-view
    current_genre="{{$current_genre}}"
    lang="{{$lang}}"
  />
</div>

@endsection
