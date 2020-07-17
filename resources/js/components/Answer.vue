<template>
    <div class="media post">
        <!--vote-->
        <vote v-bind:model="answer" name="answer"></vote>
        <!--vote-->
        <div class="media-body">
            <form v-if="editing" v-on:submit.prevent="update">
                <div class="form-group">
                    <textarea v-model="body" rows="10" class="form-control" required></textarea>
                </div>
                <button class="btn btn-sm btn-success" v-bind:disabled="isInvalid">بروزرسانی</button>
                <button class="btn btn-sm btn-warning" v-on:click="cancel">لغو</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">


                    <div class="col-4">
                        <div class="ml-auto d-flex">
                            <a v-if="authorize('modify' , answer)" class="btn btn-sm btn-primary"
                               v-on:click.prevent="edit">ویرایش</a>
                            <button v-if="authorize('modify' , answer)" v-on:click.prevent="destroy"
                                    type="submit" class="btn btn-danger btn-sm">حذف
                            </button>
                        </div>
                    </div>


                    <!--future-->
                    <div class="col-4"></div>
                    <!--end-future-->

                    <div class="col-4">
                        <user-info v-bind:model="answer" label="Answered"></user-info>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import UserInfo from './UserInfo';
    import Vote from './Vote';
    import Modification from '../Mixins/Modification';

    export default {
        name: "Answer",
        components: {UserInfo, Vote},
        props: ['answer'],
        mixins: [Modification],
        data() {
            return {
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache: null,
            }
        },

        methods: {
            setEditCache() {
                this.beforeEditCache = this.body;
            },
            restoreFromCache() {
                this.body = this.beforeEditCache;
            },
            payLoad() {
                return {
                    body: this.body
                }
            },
           delete(){
               axios.delete(this.endpoint).then(res => {
                   this.$toast.success(res.data.message, "Success", {timeout: 2000});
                   this.$emit("deleted")
               });
           }
        },
        computed: {
            isInvalid() {
                return this.body.length < 10;
            },
            endpoint() {
                return `/questions/${this.questionId}/answers/${this.id}`;
            }
        }
    }
</script>

