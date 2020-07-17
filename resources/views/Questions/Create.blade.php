@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4>ایجاد پرسش</h4>
                            <div class="ml-auto">
                                <a class="btn btn-outline-secondary" href="{{route('questions.index')}}">بازگشت به
                                    قسمت پرسرش ها</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('questions.store')}}" method="post">
                            @include("layouts._questionForm" , ['buttonText' => 'ثبت پرسش'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
