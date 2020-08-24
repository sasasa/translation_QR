@extends('layouts.app')
@section('title', 'ジャンル新規作成')

@section('content')
<form action="/genres" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf
  <div class="form-group">
    <label for="genre_key">{{__('validation.attributes.genre_key')}}:</label>
    <input value="{{old('genre_key')}}" type="text" id="genre_key" class="form-control @error('genre_key') is-invalid @enderror" name="genre_key">
    @error('genre_key')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="lang">{{__('validation.attributes.lang')}}:</label>
    {{ Form::select('lang', \App\Genre::$selectKeys, old('lang'), empty($errors->first('lang')) ? ['class'=>"form-control", 'id'=>'lang'] : ['class'=>"form-control is-invalid", 'id'=>'lang']) }}
    @error('lang')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>


  <div class="form-group">
    <label for="genre_name">{{__('validation.attributes.genre_name')}}:</label>
    <input value="{{old('genre_name')}}" type="text" id="genre_name" class="form-control @error('genre_name') is-invalid @enderror" name="genre_name">
    @error('genre_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">登録</button>
</form>
@endsection
