@extends('default::frontend.layouts.app')

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
                        <label>密码</label>
                        <input type="password" placeholder="密码" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="rememberMe" class="paper-check">
                            <input type="checkbox"
                                   id="rememberMe"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> <span>记住我</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit">登录</button>
                        <a href="{{ route('password.request') }}">忘记密码？</a>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('register') }}">注册</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection