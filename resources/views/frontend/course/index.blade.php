@extends('TemplatePaperCss::frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                @foreach($courses as $index => $course)
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

            <div class="col-12 mt-10 mb-30">
                {{$courses->render()}}
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function () {
            $('.page-item').addClass('paper-btn');
        });
    </script>
@endsection