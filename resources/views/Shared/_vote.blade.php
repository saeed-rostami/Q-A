{{--@if ($model instanceof \App\Question)--}}
    {{--@php--}}
        {{--$name = 'question';--}}
        {{--$firstURISegment = 'questions';--}}
    {{--@endphp--}}
{{--@elseif ($model instanceof \App\Answer)--}}
    {{--@php--}}
        {{--$name = 'answer';--}}
        {{--$firstURISegment = 'answers';--}}
    {{--@endphp--}}
{{--@endif--}}

{{--vote--}}

{{--@php--}}
{{--$formId = $name . "-" . $model->id;--}}
{{--$formAction = "/{$firstURISegment}/{$model->id}/vote";--}}
{{--@endphp--}}
{{--<div class="d-flex flex-column vote-controls">--}}
    {{--<a class="vote-up {{ Auth::guest() ? 'off' : '' }}" title="This {{$name}} is Useful"--}}
       {{--onclick="event.preventDefault(); document.getElementById('up-vote-{{$name}}-{{$model->id}}').submit();"--}}
    {{-->--}}
        {{--<form id="up-vote-{{$name}}-{{$model->id}}" class="d-none" method="post"--}}
              {{--action="/{{$firstURISegment}}/{{$model->id}}/vote">--}}
            {{--@csrf--}}
            {{--<input type="hidden" name="vote" value="1">--}}
        {{--</form>--}}
        {{--<i class="fa fa-caret-up fa-3x"></i>--}}
    {{--</a>--}}
    {{--<span class="votes-count">{{$model->votes_count}}</span>--}}
    {{--<a class="vote-down {{Auth::guest() ? 'off' : ''}}" title="This {{$name}} is not Useful"--}}
       {{--onclick="event.preventDefault(); document.getElementById('down-vote-{{$name}}-{{$model->id}}').submit();"--}}
    {{-->--}}
        {{--<form id="down-vote-{{$name}}-{{$model->id}}" class="d-none" method="post"--}}
              {{--action="/{{$firstURISegment}}/{{$model->id}}/vote">--}}
            {{--@csrf--}}
            {{--<input type="hidden" name="vote" value="-1">--}}
        {{--</form>--}}
        {{--<i class="fa fa-caret-down fa-3x"></i>--}}
    {{--</a>--}}

    {{--end-vote--}}

    {{--favorite-or-accept--}}
    {{--@if ($model instanceof \App\Question)--}}
        {{--@include("Shared._favorite" , ['model' => $model])--}}
        {{--<favorites v-bind:question="{{$model}}"></favorites>--}}
    {{--@elseif ($model instanceof \App\Answer)--}}
        {{--@include("Shared._accept" , ['model' => $model])--}}
        {{--<accepted v-bind:answer="{{$model}}"></accepted>--}}
    {{--@endif--}}
    {{--end-favorite-or-accept--}}

{{--</div>--}}
