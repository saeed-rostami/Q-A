<template>
    <div>
        <div class="row mt-5" v-if="count" v-cloak>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>{{title}}</h2>
                        </div>
                        <hr>
                        <answer v-on:deleted="remove(index)" v-for="(answer, index) in answers" v-bind:answer="answer" v-bind:key="answer.id"></answer>

                        <div class="text-center mt-3" v-if="nextUrl">
                            <button class="btn btn-outline-secondary" v-on:click.prevent="fetch(nextUrl)">نمایش
                            بیشتر</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <new-answer v-on:created="add" v-bind:question-id="question.id"></new-answer>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    import Answer from './Answer';
    import NewAnswer from "./NewAnswer";
    export default {
        name: "Answers",

        components:{NewAnswer, Answer},

        props: ['question'],

        data() {
            return {
                questionId: this.question.id,
                count: this.question.answers_count,
                answers: [],
                nextUrl: null
            }
        },

        created(){
            this.fetch(`/questions/${this.questionId}/answers`)
        },
        methods:{
            add(answer){
              this.answers.push(answer);
              this.count ++ ;
            },
            remove(index){
                this.answers.splice(index, 1);
                this.count --;
            },
            fetch(endpoint){
               axios.get(endpoint).then(({data}) => {
                    this.answers.push(...data.data);
                   this.nextUrl = data.next_page_url;
                })
            }
        },
        computed: {
            title() {
                return this.count + " " + (this.count > 1 ? 'Answers' : 'Answer')
            }
        },

    }
</script>

<style scoped>

</style>
