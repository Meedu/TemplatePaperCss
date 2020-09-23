@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="border">订单号：<span>{{$order['order_id']}}</span></p>

                @if($needPaidTotal > 0)
                    <p class="border">需支付总额：<span>￥{{$needPaidTotal}}</span></p>
                @else
                    <p class="border">已支付</p>
                @endif
            </div>
            <div class="col-12 mt-10 mb-10 border">
                {!! $intro !!}
            </div>
        </div>
    </div>

@endsection