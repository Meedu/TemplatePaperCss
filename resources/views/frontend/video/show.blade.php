@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="border mt-0 mb-10">{{$video['title']}}</h2>
            </div>
            <div class="col-12">
                <div class="video-player-container">
                    @if($user)
                        @if($canSeeVideo)
                            @if($video['aliyun_video_id'] && (int)($gConfig['system']['player']['enabled_aliyun_private'] ?? 0) === 1)
                                @include('TemplatePaperCss::frontend.components.player.aliyun', ['video' => $video])
                            @else
                                @if($video['player_pc'] === \App\Constant\FrontendConstant::PLAYER_ALIYUN)
                                    @include('TemplatePaperCss::frontend.components.player.aliyun', ['video' => $video])
                                @elseif($video['player_pc'] === \App\Constant\FrontendConstant::PLAYER_TENCENT)
                                    @include('TemplatePaperCss::frontend.components.player.tencent', ['video' => $video])
                                @else
                                    @include('TemplatePaperCss::frontend.components.player.xg', ['video' => $video])
                                @endif
                            @endif
                        @else
                            <a href="{{route('member.course.buy', $video['course_id'])}}"
                               class="paper-btn primary video-play-option-btn">购买课程</a>
                        @endif
                    @else
                        <a href="{{route('login')}}" class="paper-btn primary video-play-option-btn">登录</a>
                    @endif
                </div>
            </div>
            <div class="col-12 mt-10">
                <h4 class="border mt-0 mb-10">章节</h4>
                @foreach($videos as $item)
                    @foreach($item as $videoItem)
                        <a href="{{route('video.show', [$videoItem['course_id'], $videoItem['id'], $videoItem['slug']])}}"
                           class="video-item border mb-10 {{$videoItem['id'] === $video['id'] ? 'active' : ''}}">
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
                <div class="course-desc">{!! $video['render_desc'] !!}</div>
            </div>
        </div>
    </div>

@endsection