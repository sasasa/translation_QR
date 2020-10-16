@extends('layouts.base')
@section('title', "メニュー")
@section('description', "メニュー")

@section('content')

<div id="app">
  <router-view
    seat_hash="{{$seat_hash}}"
    session_key="{{$session_key}}"
  />
</div>

@endsection
