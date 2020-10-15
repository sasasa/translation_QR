@extends('layouts.app')
@section('title', 'アレルギー品目編集')

@section('content')
<h1>アレルギー品目編集</h1>

@include('components.errorAll')

<form action="/allergens/{{$allergen->id}}" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf
  @method('PATCH')

  <div class="form-group">
    <label for="allergen_key">{{__('validation.attributes.allergen_key')}}:</label>
    <input readonly value="{{old('allergen_key', $allergen->allergen_key)}}" type="text" id="allergen_key" class="form-control @error('allergen_key') is-invalid @enderror" name="allergen_key">
    @error('allergen_key')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="lang_jp">{{__('validation.attributes.lang')}}:</label>
    <input readonly value="{{old('lang', $allergen->lang_jp)}}" type="text" id="lang_jp" class="form-control @error('lang_jp') is-invalid @enderror" name="lang_jp">
    <input value="{{old('lang', $allergen->lang)}}" type="hidden" id="lang" name="lang">
    @error('lang')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="allergen_name">{{__('validation.attributes.allergen_name')}}:</label>
    <input value="{{old('allergen_name', $allergen->allergen_name)}}" type="text" id="allergen_name" class="form-control @error('allergen_name') is-invalid @enderror" name="allergen_name">
    @error('allergen_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">編集</button>
</form>
@endsection