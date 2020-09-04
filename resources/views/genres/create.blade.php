@extends('layouts.app')
@section('title', 'ジャンル新規作成')

@section('content')
<h1>ジャンル新規作成</h1>

@include('components.errorAll')

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

  <div class="form-group">
    <label for="genre_order">{{__('validation.attributes.genre_order')}}:</label>
    <input value="{{old('genre_order')}}" type="text" id="genre_order" class="form-control @error('genre_order') is-invalid @enderror" name="genre_order">
    @error('genre_order')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="parent_id">{{__('validation.attributes.parent_id')}}:</label>
    {{ Form::select('parent_id', \App\Genre::optionsForSelectParents(), old('parent_id'), empty($errors->first('parent_id')) ? ['class'=>"form-control", 'id'=>'parent_id'] : ['class'=>"form-control is-invalid", 'id'=>'parent_id']) }}
    @error('parent_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">登録</button>
</form>
@endsection

@section('script')
@include('components.createOptions');
@endsection