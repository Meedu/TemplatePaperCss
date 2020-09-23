@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="border">订单号：<span>{{$order['order_id']}}</span></p>
                <p class="border">需支付总额：<span>￥{{$needPaidTotal}}</span></p>
            </div>
            <div class="col-12 mt-10 mb-10 text-center">
                {!! QrCode::size(300)->generate($qrcodeUrl); !!}
                <p>请使用微信扫一扫支付</p>
            </div>
        </div>
    </div>

@endsection