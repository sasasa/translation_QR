@extends('layouts.base')
@section('title', $current_genre)
@section('description', $current_genre)

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
