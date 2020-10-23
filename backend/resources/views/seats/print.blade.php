@extends('layouts.print')
@section('title', $seat->seat_name. '席QRコード')

@section('content')
<div class="print_page">
  <h1>Menu</h1>
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