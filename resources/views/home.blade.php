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

                    <a href="/genres" class="btn btn-primary">ジャンル管理</a>
                    <a href="/items" class="btn btn-primary">メニューアイテム管理</a>
                    <a href="/ja/food/items" class="btn btn-primary">メニュー確認</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
