@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    @csrf
                    <input type="hidden" name="goods_id" value="{{$goods['id']}}">

                    <input type="hidden" name="payment_scene" value="{{$scene}}">
                    <input type="hidden" name="payment_sign" value="">

                    <h3>{{$goods['title']}}</h3>
                    <div class="mb-30">总价：￥{{$goods['charge']}}</div>

                    <div class="payments">
                        @foreach($payments as $payment)
                            <div class="payment-item {{$loop->first ? 'active' : ''}}">
                                <img src="{{$payment['logo']}}" width="170" height="60"
                                     data-payment="{{$payment['sign']}}">
                            </div>
                        @endforeach
                    </div>

                    <button type="submit">立即支付</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function () {
            $('input[name="payment_sign"]').val($('.payment-item.active').find('img').first().attr('data-payment'));

            $('.payment-item').click(function () {
                $(this).addClass('active').siblings().removeClass('active');

                $('input[name="payment_sign"]').val($(this).find('img').first().attr('data-payment'));
            });
        });
    </script>
@endsection