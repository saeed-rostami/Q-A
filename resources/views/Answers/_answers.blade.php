{{--@if ($answersCount > 0)--}}
    {{--<div class="row mt-5" v-cloak>--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="card">--}}
                {{--<div class="card-body">--}}
                    {{--<div class="card-title">--}}
                        {{--<h2>{{ $answersCount . " " . Str::plural('Answer' , $answersCount) }}</h2>--}}
                    {{--</div>--}}
                    {{--<hr>--}}
                    {{--@include('layouts._message')--}}
                    {{--@foreach ($answers as $answer)--}}
                      {{--@include('Answers._answer')--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endif--}}
