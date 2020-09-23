@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="border mt-0 mb-10">
                    {{$course['title']}}
                    @if($course['charge'] === 0)
                        <span class="badge success">免费</span>
                    @else
                        <span class="badge danger">￥{{$course['charge']}}</span>
                    @endif
                    <span class="badge primary">{{$course['user_count']}}人</span>
                    @if($isBuy === false && $course['charge'] > 0)
                        <a href="{{route('member.course.buy', [$course['id']])}}" class="paper-btn danger">购买</a>
                    @endif
                </h2>
            </div>
            <div class="col-12">
                <h4 class="border mt-0 mb-10">章节</h4>
                @foreach($videos as $item)
                    @foreach($item as $videoItem)
                        <a href="{{route('video.show', [$videoItem['course_id'], $videoItem['id'], $videoItem['slug']])}}"
                           class="video-item border mb-10">
                            <div class="video-title">
                                @if($videoItem['charge'] === 0)
                                    <span class="badge success">试看</span>
                                @endif
                                {{$videoItem['title']}}
                            </div>
                            <div class="video-duration">{{duration_humans($videoItem['duration'])}}</div>
                        </a>
                    @endforeach
                @endforeach
            </div>
            <div class="col-12">
                <h4 class="border mt-0 mb-10">详情</h4>
                <div class="course-desc">{!! $course['render_desc'] !!}</div>
            </div>
        </div>
    </div>

@endsection