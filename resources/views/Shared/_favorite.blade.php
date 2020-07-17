{{--<a title="Add Favorite" class="favorite mt-3 {{Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '')}}"--}}
   {{--onclick="event.preventDefault(); document.getElementById('favorite-question-{{$model->id}}').submit();"--}}
{{-->--}}

    {{--<i class="fa fa-star fa-2x"></i>--}}
    {{--<span class="favorites-count">{{$model->favorites_count}}</span>--}}
{{--</a>--}}

{{--<form id="favorite-question-{{$model->id}}" class="d-none" method="post" action="/questions/{{ $model->id }}/favorites">--}}
    {{--@csrf--}}
    {{--@if ($model->is_favorited)--}}
        {{--@method("DELETE")--}}
    {{--@endif--}}
{{--</form>--}}