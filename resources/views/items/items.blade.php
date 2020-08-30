@extends('layouts.app')
@section('title', "タイトル")
@section('description', "デスクリプション")

@section('content')

<div id="app">
  <router-view
    current_genre="{{$current_genre}}"
    lang="{{$lang}}"
    seat_hash="{{$seat_hash}}"
    session_key="{{$session_key}}"
  />
</div>

@endsection
