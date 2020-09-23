@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label>手机号</label>
                        <input type="text" placeholder="手机号" name="mobile" required>
                    </div>
                    <div class="form-group">
                        <label>验证码</label>
                        <input type="text" name="captcha" placeholder="验证码" class="form-control" required>
                        <img src="{{ captcha_src() }}" class="captcha" width="120" height="48">
                    </div>
                    <div class="form-group">
                        <label>手机验证码</label>
                        <input type="text" name="sms_captcha" placeholder="手机验证码" class="form-control" required>
                        <input type="hidden" name="sms_captcha_key" value="password_reset">
                        <button type="button" class="send-sms-captcha paper-btn">发送验证码</button>
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <input type="password" placeholder="密码" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>确认密码</label>
                        <input type="password" placeholder="确认密码" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">重置密码</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function () {
            $('.captcha').click(function () {
                var src = $(this).attr('src');
                src = src.split('?');
                src = src[0];
                src += '?' + Math.random();
                $(this).attr('src', src);
            });

            var SMS_CYCLE_TIME = 120;
            var SMS_CURRENT_TIME = 0;

            $('.send-sms-captcha').click(function () {
                var mobile = $('input[name="mobile"]').val().trim(),
                    captcha = $('input[name="captcha"]').val().trim();
                if (mobile.length === 0 || captcha.length === 0) {
                    alert('请输入手机号和图形验证码');
                    return;
                }

                let token = $('meta[name="csrf-token"]').attr('content');
                $(this).attr('disabled', true);
                $.post('/sms/send', {
                    mobile: mobile,
                    captcha: captcha,
                    method: $('input[name="sms_captcha_key"]').val(),
                    _token: token
                }, function (res) {
                    if (res.code !== 0) {
                        $('.send-sms-captcha').attr('disabled', false);
                        alert(res.message);
                        $('.captcha').click();
                        return;
                    }

                    SMS_CURRENT_TIME = SMS_CYCLE_TIME;
                    var smsInterval = setInterval(function () {
                        if (SMS_CURRENT_TIME <= 1) {
                            $('.send-sms-captcha').text('发送验证码');
                            $('.send-sms-captcha').attr('disabled', false);
                            clearInterval(smsInterval);
                            return;
                        }
                        SMS_CURRENT_TIME = SMS_CURRENT_TIME - 1;
                        $('.send-sms-captcha').text(SMS_CURRENT_TIME + 's');
                        $('.send-sms-captcha').attr('disabled', true);
                    }, 1000);
                }, 'json');
            });
        });
    </script>
@endsection