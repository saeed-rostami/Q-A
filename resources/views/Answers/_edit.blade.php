@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h3>Edit Your Answer for question: <strong>{{$question->title}}</strong> </h3>
                            <div class="ml-auto">
                                <a class="btn btn-outline-secondary" href="{{route('questions.show' , $question->slug)}}">Back To The
                                    Question</a>
                            </div>
                        </div>
                        <hr>
                        <form action="{{route('questions.answers.update' , [$question->id , $answer->id])}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" rows="7" name="body">{{ old('body', $answer->body) }}</textarea>
                                @if ($errors->has('body'))
                                    <div class="invalid-feedback">
                                        <strong>{{$errors->first('body')}}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg btn-outline-primary" type="submit">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

