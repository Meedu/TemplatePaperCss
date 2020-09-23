@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="border">订单号：<span>{{$order['order_id']}}</span></p>
                <p class="border">支付成功</p>
            </div>
        </div>
    </div>

@endsection