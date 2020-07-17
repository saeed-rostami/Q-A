{{--@can('accept' , $model)--}}
    {{--<a title="Best Answer" class="{{$model->status}} mt-3" onclick="event.preventDefault(); document.getElementById('accept-answer-{{$model->id}}').submit();">--}}
        {{--<i class="fa fa-check fa-2x"></i>--}}
    {{--</a>--}}
    {{--<form id="accept-answer-{{$model->id}}" class="d-none" method="post" action="{{route('answers.accept' , $model->id)}}">--}}
        {{--@csrf--}}
    {{--</form>--}}
{{--@else--}}
    {{--@if ($model->is_best)--}}
        {{--<a title="This answer is best answer" class="{{$model->status}} mt-3">--}}
            {{--<i class="fa fa-check fa-2x"></i>--}}
        {{--</a>--}}
    {{--@endif--}}
{{--@endcan--}}