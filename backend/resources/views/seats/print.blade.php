@extends('layouts.print')
@section('title', $seat->seat_name. '席QRコード')

@section('content')
<div class="print_page">
  <div class="flex-box">
    <h1>Menu</h1>
    <p class="flex-box__paragraph">{{$seat->seat_name}}</p>
  </div>
  <img src="/qr_code/{{$seat->id}}">
</div>
@endsection

@section('script')
<script type="module">
$(function(){
  setTimeout(function(){
    window.print()
    setTimeout(function(){
      window.close()
    }, 1000)
  }, 500)
})
</script>
@endsection