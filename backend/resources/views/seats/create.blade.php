@extends('layouts.app')
@section('title', '座席新規作成')

@section('content')
<h1>座席新規作成</h1>

@include('components.errorAll')

<form action="/seats" method="post" class="mt-5">
  @csrf
  <div class="form-group">
    <label for="seat_name">{{__('validation.attributes.seat_name')}}:</label>
    <input value="{{old('seat_name')}}" type="text" id="seat_name" class="form-control @error('seat_name') is-invalid @enderror" name="seat_name">
    @error('seat_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="how_many">{{__('validation.attributes.how_many')}}:</label>
    <input value="{{old('how_many')}}" type="number" id="how_many" class="form-control @error('how_many') is-invalid @enderror" name="how_many">
    @error('how_many')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  
  <button type="submit" class="btn btn-primary">登録</button>
</form>
@endsection

@section('script')
<script type="module">
</script>
@endsection