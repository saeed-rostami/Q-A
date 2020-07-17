{{--<answer v-bind:answer="{{$answer}}" inline-template xmlns:v-on="http://www.w3.org/1999/xhtml"--}}
        {{--xmlns:v-bind="http://www.w3.org/1999/xhtml">--}}
    {{--<div class="media post">--}}
        {{--vote--}}
        {{--<vote v-bind:model="{{$answer}}" name="answer"></vote>--}}
        {{--end-vote--}}
        {{--<div class="media-body">--}}
            {{--<form v-if="editing" v-on:submit.prevent="update">--}}
                {{--<div class="form-group">--}}

                    {{--<textarea v-model="body" rows="10" class="form-control" required></textarea>--}}

                {{--</div>--}}
                {{--<button class="btn btn-sm btn-success" v-bind:disabled="isInvalid">Update</button>--}}
                {{--<button class="btn btn-sm btn-warning" v-on:click="cancel">Cancel</button>--}}
            {{--</form>--}}
           {{--<div v-else>--}}
               {{--<div v-html="bodyHtml"></div>--}}
               {{--<div class="row">--}}

                   {{--edit and delete-answer--}}
                   {{--<div class="col-4">--}}
                       {{--<div class="ml-auto d-flex">--}}


                           {{--@can('update', $answer)--}}
                               {{--<a class="btn btn-sm btn-primary"--}}
                                  {{--v-on:click.prevent="edit">Edit</a>--}}
                           {{--@endcan--}}




                           {{--@can('delete', $answer)--}}

                                   {{--<button v-on:click.prevent="destroy"--}}
                                           {{--type="submit" class="btn btn-danger btn-sm">Delete--}}
                                   {{--</button>--}}
                           {{--@endcan--}}


                       {{--</div>--}}
                   {{--</div>--}}
                   {{--end-edit and delete-answer--}}

                   {{--future--}}
                   {{--<div class="col-4"></div>--}}
                   {{--future--}}

                   {{--user-detail-answer--}}
                   {{--<div class="col-4">--}}
                       {{--<user-info v-bind:model="{{$answer}}" label="Answered"></user-info>--}}
                   {{--</div>--}}
                   {{--end-user-detail-answer--}}
               {{--</div>--}}
           {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</answer>--}}
