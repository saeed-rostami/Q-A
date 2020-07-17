<div class="media post">
    {{--votes--}}
    <div class="d-flex flex-column counters">
        <div class="vote">
            <strong>{{$question->votes_count}}</strong> {{Str::plural('vote', $question->votes_count)}}
        </div>

        <div class="status {{$question->status}}">
            <strong>{{$question->answers_count}}</strong> {{Str::plural('answer', $question->answers_count)}}
        </div>

        <div class="view">
            {{$question->views . " " . Str::plural('view' , $question->views)}}
        </div>
    </div>
    {{--end-votes--}}
    <div class="media-body">
        {{--delete & edit--}}
        <div class="d-flex align-items-center">
            <h3 class="mt-0">
                <a href="{{$question->url}}">{{$question->title}}</a>
            </h3>
            <div class="ml-auto d-flex">


                @can('update', $question)
                    <a href="{{route('questions.edit' , $question->id)}}"
                       class="btn btn-sm btn-primary">ویرایش</a>
                @endcan




                @can('delete', $question)
                    <form method="post"
                          action="{{route('questions.destroy' , $question->id)}}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm ('Are You Sure Want To Delete This Question?');"
                                type="submit" class="btn btn-danger btn-sm">حذف
                        </button>
                    </form>
                @endcan


            </div>
        </div>
        {{--end-delete & edit--}}


        <p class="lead">
            Asked by :
            <a href="{{$question->user->url}}">{{$question->user->name}}</a>
            <small class="text-muted">{{$question->created_date}}</small>
        </p>
        <div>{{ $question->excerpt(350) }}</div>
    </div>
</div>
