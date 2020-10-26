@extends('layouts.app')
@section('title', 'ユーザー新規作成')

@section('content')
<h1>ユーザー新規作成</h1>

@include('components.errorAll')

<form action="/users" method="post" class="mt-5" autocomplete="off">
  <input type="password" name="dummy_pass" style="top: -100px; left: -100px;　position: fixed;">
  <input type="email" name="dummy_email" style="top: -100px; left: -100px;　position: fixed;">
  @csrf
  <div class="form-group">
    <label for="name">{{__('validation.attributes.name')}}:</label>
    <input value="{{old('name')}}" type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name">
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="email">{{__('validation.attributes.email')}}:</label>
    <input value="{{old('email')}}" type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="off">
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="password">{{__('validation.attributes.password')}}:</label>
    <input value="{{old('password')}}" type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">
    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="password_confirmation">{{__('validation.attributes.password_confirmation')}}:</label>
    <input value="{{old('password_confirmation')}}" type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
    @error('password_confirmation')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  
  
  <div class="form-group">
    <label for="permission">{{__('validation.attributes.permission')}}:</label>
    {{ Form::select('permission', \App\User::$permissions, old('permission'), empty($errors->first('permission')) ? ['class'=>"form-control", 'id'=>'permission'] : ['class'=>"form-control is-invalid", 'id'=>'permission']) }}
</div>
  <button type="submit" class="btn btn-primary">登録</button>
</form>
@endsection

@section('script')
<script type="module">
</script>
@endsection