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

                    @can('editting')
                    <a href="/users" class="btn btn-danger my-1">ユーザー管理</a>
                    <a href="/genres" class="btn btn-danger my-1">ジャンル管理</a>
                    <a href="/allergens" class="btn btn-danger my-1">アレルギー品目管理</a>
                    <a href="/items" class="btn btn-danger my-1">メニュー管理</a>
                    <a href="/seats" class="btn btn-danger my-1">座席管理</a>
                    @endcan

                    @can('browsing')
                    <a href="/sum_total" class="btn btn-primary my-1">売上確認</a>
                    <a href="/orders" class="btn btn-primary my-1">注文・お会計確認</a>
                    <a href="/aggregate" class="btn btn-primary my-1">人気商品確認</a>
                    @if(env('PAYPAY_API_KEY', null))
                        <a href="/webhooks" class="btn btn-primary my-1">paypay履歴確認</a>
                    @endif
                    <div class="form-group col-auto">
                        <label for="seat">席を選択してメニュー表示</label>
                        {{ Form::select('seat', \App\Seat::forSelect(), old('seat'), empty($errors->first('seat')) ? ['class'=>"form-control", 'id'=>'seat'] : ['class'=>"form-control is-invalid", 'id'=>'seat']) }}
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="module">

$(function(){
    $("#seat").change(function() {
        let hash = $(this).val()
        if(!!hash) {
            open("/" + hash + "/items#/ja/drink")
        }
    });
});
</script>
@endsection