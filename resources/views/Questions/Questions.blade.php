@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4>Questions</h4>
                            <div class="ml-auto">
                                <a class="btn btn-outline-secondary" href="{{route('questions.create')}}">Ask
                                    Question</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts._message')
                        @forelse ($questions as $question)
                            @include('Questions._excerpt')
                            @empty
                            <div class="alert alert-warning">
                                <strong>Sorry</strong>There Is no Question Available!
                            </div>
                        @endforelse
                        <div class="d-flex justify-content-center mt-2">
                            {{$questions->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
