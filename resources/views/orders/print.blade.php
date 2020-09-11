@extends('layouts.app')
@section('title', 'プリント')

@section('content')
<print-component
seatsessionid="{{$seatSessionID}}"
>
</print-component>
@endsection