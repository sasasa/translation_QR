@extends('layouts.app')
@section('title', 'アレルギー品目新規作成')

@section('content')
<h1>アレルギー品目新規作成</h1>

@include('components.errorAll')

<form action="/allergens" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf
  <div class="form-group">
    <label for="allergen_key">{{__('validation.attributes.allergen_key')}}:</label>
    <input value="{{old('allergen_key')}}" type="text" id="allergen_key" class="form-control @error('allergen_key') is-invalid @enderror" name="allergen_key">
    @error('allergen_key')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="lang">{{__('validation.attributes.lang')}}:</label>
    {{ Form::select('lang', \App\Allergen::$selectKeys, old('lang'), empty($errors->first('lang')) ? ['class'=>"form-control", 'id'=>'lang'] : ['class'=>"form-control is-invalid", 'id'=>'lang']) }}
    @error('lang')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="allergen_name">{{__('validation.attributes.allergen_name')}}:</label>
    <input value="{{old('allergen_name')}}" type="text" id="allergen_name" class="form-control @error('allergen_name') is-invalid @enderror" name="allergen_name">
    @error('allergen_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">登録</button>
</form>
@endsection