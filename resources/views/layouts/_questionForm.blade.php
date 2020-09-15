@csrf
<div class="form-group {{$errors->has('title') ? 'is-invalid' : ''}}">
    <label for="question_title">تیتر پرسش</label>
    <input type="text" value="{{old('title' , $question->title ?? '')}}" name="title" id="question_title"
           class="form-control">
</div>
@if ($errors->has('title'))
    <div class="invalid-feedback">
        <strong>{{$errors->first('title')}}</strong>
    </div>
@endif


<div class="form-group {{$errors->has('body') ? 'is-invalid' : ''}}">
    <label for="question_body">متن پرسش</label>
    <textarea type="text" rows="10" name="body" id="question_body"
              class="form-control">{{old('body' , $question->body ?? '')}}</textarea>
</div>
@if ($errors->has('body'))
    <div class="invalid-feedback">
        <strong>{{$errors->first('body')}}</strong>
    </div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{$buttonText}}</button>
</div>
