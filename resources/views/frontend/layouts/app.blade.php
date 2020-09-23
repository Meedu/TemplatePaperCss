<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{$keywords ?? ''}}">
    <meta name="description" content="{{$description ?? ''}}">
    <title>{{$title ?? ''}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/papercss@1.8.0/dist/paper.min.css">
    <link rel="stylesheet" href="{{asset('/addons/TemplatePaperCss/app.css')}}?v=20200923">
    @yield('css')
</head>
<body>

<!-- 导航栏 -->
<div class="container mt-10">
    <div class="row">
        <div class="col-12">
            <nav class="border split-nav">
                <div class="nav-brand">
                    <h3><a href="{{url('/')}}">{{config('app.name')}}</a></h3>
                </div>
                <div class="collapsible">
                    <div class="collapsible-body">
                        <ul class="inline">
                            <li><a href="{{url('/')}}">首页</a></li>
                            <li><a href="{{route('courses')}}">全部课程</a></li>
                            <li>
                                @if($user)
                                    <a href="{{route('member')}}">{{$user['nick_name']}}</a>
                                @else
                                    <a href="{{route('login')}}">登录</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

@yield('content')

<div class="display-none">
    <label class="meedu-alert-modal-label" for="meedu-alert-modal"></label>
</div>
<input class="modal-state" id="meedu-alert-modal" type="checkbox">
<div class="modal meedu-alert">
    <label class="modal-bg" for="meedu-alert-modal"></label>
    <div class="modal-body">
        <label class="btn-close" for="meedu-alert-modal">X</label>
        <h4 class="modal-title"></h4>
        <p class="modal-text"></p>
    </div>
</div>

<script crossorigin="anonymous" integrity="sha384-LVoNJ6yst/aLxKvxwp6s2GAabqPczfWh6xzm38S/YtjUyZ+3aTKOnD/OJVGYLZDl"
        src="https://lib.baomitu.com/jquery/3.5.0/jquery.min.js"></script>
<script>
    @if(get_first_flash('success'))
    $('.meedu-alert .modal-title').text('成功');
    $('.meedu-alert .modal-text').text("{{get_first_flash('success')}}");
    $('.meedu-alert-modal-label').click();
    @endif
    @if(get_first_flash('warning'))
    $('.meedu-alert .modal-title').text('警告');
    $('.meedu-alert .modal-text').text("{{get_first_flash('warning')}}");
    $('.meedu-alert-modal-label').click();
    @endif
    @if(get_first_flash('error'))
    $('.meedu-alert .modal-title').text('错误');
    $('.meedu-alert .modal-text').text("{{get_first_flash('error')}}");
    $('.meedu-alert-modal-label').click();
    @endif
</script>
@yield('js')
<div style="display:none">{!! config('meedu.system.js') !!}</div>
</body>
</html>