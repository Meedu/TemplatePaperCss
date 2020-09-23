@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <!-- 首页banner -->
    @foreach($banners as $i => $banner)
        <div class="container mt-10">
            <div class="row">
                <div class="col-12">
                    <h3 class="border mt-0">{{$banner['name']}}</h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach($banner['courses'] as $index => $course)
                            <div class="col-12 mb-30">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$course['title']}}</h4>
                                        <div class="card-text course-short-description">{{$course['short_description']}}</div>
                                        <a class="paper-btn"
                                           href="{{route('course.show', [$course['id'], $course['slug']])}}">
                                            立即学习
                                            @if($course['charge'] === 0)
                                                <span class="badge success">免费</span>
                                            @else
                                                <span class="badge danger">￥{{$course['charge']}}</span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="border mt-0">友情链接</h3>
            </div>
            <div class="col-12">
                @foreach($links as $link)
                    <a href="{{$link['url']}}" class="paper-btn" target="_blank">{{$link['name']}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection