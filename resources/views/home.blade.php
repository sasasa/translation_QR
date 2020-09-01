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

                    <a href="/genres" class="btn btn-danger">ジャンル管理</a>
                    <a href="/items" class="btn btn-danger">メニューアイテム管理</a>
                    <a href="/seats" class="btn btn-danger">座席管理</a>
                    <a href="/orders" class="btn btn-primary">注文確認</a>

                    <a href="/{{\App\Seat::find(1)->seat_hash}}/ja/drink/items" class="btn btn-primary">メニュー確認</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
