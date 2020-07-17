@extends('layouts.app')

@section('content')

    <div class="container">
    <question-page v-bind:question="{{$question}}"></question-page>
    </div>

@endsection
<script>
    import Test from "../../js/components/test";
    export default {
        components: {Test}
    }
</script>
