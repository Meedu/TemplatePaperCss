@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="border">用户ID：{{$user['id']}}</p>
                <p class="border">昵称：{{$user['nick_name']}}</p>
                <p class="border">注册时间：{{$user['created_at']}}</p>
                @if($user['role'])
                    <p class="border">会员：{{$user['role']['name']}}</p>
                @endif
                <p>
                    <a href="javascript:void(0);" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">安全退出</a>
                <form class="d-none" id="logout-form" action="{{ route('logout') }}"
                      method="POST"
                      style="display: none;">
                    @csrf
                </form>
                </p>
            </div>
        </div>
    </div>

@endsection