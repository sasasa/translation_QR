@extends('layouts.app')
@section('title', '他言語メニュー作成')

@section('content')
<h1>他言語メニュー作成</h1>

@include('components.errorAll')

<form action="/items/create_by_key/{{$item->id}}" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf

  <div class="form-group">
    <label for="item_key">{{__('validation.attributes.item_key')}}:</label>
    <input readonly value="{{old('item_key', $item->item_key)}}" type="text" id="item_key" class="form-control @error('item_key') is-invalid @enderror" name="item_key">
    @error('item_key')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="lang">{{__('validation.attributes.lang')}}:</label>
    {{ Form::select('lang', \App\Item::$selectKeysWithoutJP, old('lang'), empty($errors->first('lang')) ? ['class'=>"form-control", 'id'=>'lang'] : ['class'=>"form-control is-invalid", 'id'=>'lang']) }}
    @error('lang')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="item_name">{{__('validation.attributes.item_name')}}:</label>
    <input value="{{old('item_name', $item->item_name)}}" type="text" id="item_name" class="form-control @error('item_name') is-invalid @enderror" name="item_name">
    @error('item_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="item_desc">{{__('validation.attributes.item_desc')}}:</label>
    <textarea rows="10" id="item_desc" class="form-control @error('item_desc') is-invalid @enderror" name="item_desc">{{old('item_desc', $item->item_desc)}}</textarea>
    @error('item_desc')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <img src="/storage/{{$item->image_path}}?{{ str_random(8) }}">
  </div>

  <button type="submit" class="btn btn-primary">登録</button>
</form>
@endsection


@section('script')
<script type="module">
$(function() {
})
</script>
@endsection