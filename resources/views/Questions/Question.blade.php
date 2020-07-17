@extends('layouts.app')

@section('content')

    <div class="container">
    <question-page v-bind:question="{{$question}}"></question-page>
    </div>

@endsection
