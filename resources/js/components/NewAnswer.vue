<template>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>پاسخ شما</h3>
                        </div>
                        <hr>
                        <form method="post" v-on:submit.prevent="create">

                            <div class="form-group">
                                <textarea class="form-control" rows="7" name="body" v-model="body" required></textarea>
                            </div>
                            <div class="form-group">
                                <button v-bind:disabled="isInvalid" class="btn btn-lg btn-outline-primary"
                                        type="submit">ارسال</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "NewAnswer",
        props: ["questionId"],
        data() {
            return {
                body: ""
            }
        },
        methods: {
            create(){
                axios.post(`/questions/${this.questionId}/answers`, {
                    body: this.body
                })
                    .catch(error => {
                        this.$toast.error(error.response.data.message , "Error") })
                    .then(({data}) => {
                        this.$toast.success(data.message , "Success");
                        this.body = "";
                         this.$emit("created" , data.answer);
                    })
            }
        },
        computed: {
            isInvalid(){
                return !this.signedIn || this.body.length < 10 ;
            }
        }
    }
</script>

<style scoped>

</style>
