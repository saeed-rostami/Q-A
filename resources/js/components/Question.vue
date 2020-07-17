<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-if="editing" v-on:submit.prevent="update">
                    <div class="card-title">
                        <input type="text" class="form-control form-control-lg" v-model="title">
                    </div>

                    <hr>

                    <div class="media">
                        <div class="media-body">

                            <div class="form-group">

                                <textarea v-model="body" rows="10" class="form-control" required></textarea>

                            </div>
                            <button class="btn btn-sm btn-success" v-bind:disabled="isInvalid">ویرایش</button>
                            <button class="btn btn-sm btn-warning" v-on:click="cancel">لغو</button>
                        </div>
                    </div>
                </form>


                <div class="card-body" v-else>
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h4>{{title}}</h4>
                            <div class="ml-auto">
                                <a class="btn btn-outline-secondary" href="/questions">بازگشت به
                                    قسمت پرسرش ها</a>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="media">
                        <vote v-bind:model="question" name="question"></vote>
                        <div class="media-body">
                            <div v-html="bodyHtml"></div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto d-flex">
                                        <a v-if="authorize('modify' , question)" class="btn btn-sm btn-primary"
                                           v-on:click.prevent="edit">ویرایش</a>
                                        <button v-if="authorize('deleteQuestion' , question)" v-on:click.prevent="destroy"
                                                type="submit" class="btn btn-danger btn-sm">حذف
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <user-info v-bind:model="question" label="Asked"></user-info>
                                </div>
                            </div>

                        </div>
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
        name: "Question",
        components: {UserInfo, Vote},
        props: ['question'],
        mixins: [Modification],

        data() {
            return {
                title: this.question.title,
                body: this.question.body,
                bodyHtml: this.question.body_html,
                id: this.question.id,
                beforeEditCache: {},
            }
        },

        computed: {
            isInvalid() {
                return this.title.length < 10 || this.body < 10;
            },
            endpoint() {
                return `/questions/${this.id}`
            }
        },
        methods: {
            setEditCache() {
                this.beforeEditCache = {
                    body: this.body,
                    title: this.title
                };
            },

            restoreFromCache() {
                this.body = this.beforeEditCache.body;
                this.title = this.beforeEditCache.title;
            },

            payLoad(){
                return {
                    body: this.body,
                    title: this.title
                }
            },

            delete(){
                axios.delete(this.endpoint).then(({data}) => {
                    this.$toast.success(data.message, "Success", {timeout: 2000});
                });

                setTimeout(() => {
                    window.location.href = "/questions"
                }, 3000);
            }

        }
    }
</script>

<style scoped>

</style>
