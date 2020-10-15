@extends('layouts.app')
@section('title', 'ジャンル編集')

@section('content')
<h1>ジャンル編集</h1>

@include('components.errorAll')

<form action="/genres/{{$genre->id}}" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf
  @method('PATCH')

  <div class="form-group">
    <label for="genre_key">{{__('validation.attributes.genre_key')}}:</label>
    <input readonly value="{{old('genre_key', $genre->genre_key)}}" type="text" id="genre_key" class="form-control @error('genre_key') is-invalid @enderror" name="genre_key">
    @error('genre_key')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="lang_jp">{{__('validation.attributes.lang')}}:</label>
    <input readonly value="{{old('lang', $genre->lang_jp)}}" type="text" id="lang_jp" class="form-control @error('lang') is-invalid @enderror" name="lang_jp">
    <input value="{{old('lang', $genre->lang)}}" type="hidden" id="lang" name="lang">
    @error('lang')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>


  <div class="form-group">
    <label for="genre_name">{{__('validation.attributes.genre_name')}}:</label>
    <input value="{{old('genre_name', $genre->genre_name)}}" type="text" id="genre_name" class="form-control @error('genre_name') is-invalid @enderror" name="genre_name">
    @error('genre_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="genre_order">{{__('validation.attributes.genre_order')}}:</label>
    <input value="{{old('genre_order', $genre->genre_order)}}" type="text" id="genre_order" class="form-control @error('genre_order') is-invalid @enderror" name="genre_order">
    @error('genre_order')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="parent_id">{{__('validation.attributes.parent_id')}}:</label>
    {{ Form::select('parent_id', $genre->optionsForSelectParentsByLangForInstance(), old('parent_id', $genre->parent_id), empty($errors->first('parent_id')) ? ['class'=>"form-control", 'id'=>'parent_id'] : ['class'=>"form-control is-invalid", 'id'=>'parent_id']) }}
    @error('parent_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">編集</button>
</form>
@endsection


