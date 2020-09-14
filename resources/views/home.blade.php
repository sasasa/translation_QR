@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/genres" class="btn btn-danger  my-1">ジャンル管理</a>
                    <a href="/allergens" class="btn btn-danger  my-1">アレルギー品目管理</a>
                    <a href="/items" class="btn btn-danger  my-1">メニュー管理</a>
                    <a href="/seats" class="btn btn-danger  my-1">座席管理</a>
                    <a href="/orders" class="btn btn-primary  my-1">注文・お会計確認</a>

                    <a href="/{{\App\Seat::find(1)->seat_hash}}/ja/drink/items" class="btn btn-primary  my-1">S0メニュー確認</a>
                    <a href="/{{\App\Seat::find(2)->seat_hash}}/ja/drink/items" class="btn btn-primary  my-1">S1メニュー確認</a>
                    <a href="/{{\App\Seat::find(3)->seat_hash}}/ja/drink/items" class="btn btn-primary  my-1">S2メニュー確認</a>
                    <a href="/{{\App\Seat::find(4)->seat_hash}}/ja/drink/items" class="btn btn-primary  my-1">S3メニュー確認</a>
                    <a href="/{{\App\Seat::find(5)->seat_hash}}/ja/drink/items" class="btn btn-primary  my-1">S4メニュー確認</a>
                    <a href="/{{\App\Seat::find(6)->seat_hash}}/ja/drink/items" class="btn btn-primary  my-1">S5メニュー確認</a>
                    <a href="/{{\App\Seat::find(7)->seat_hash}}/ja/drink/items" class="btn btn-primary  my-1">S6メニュー確認</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
