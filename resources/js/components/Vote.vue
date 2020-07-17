<template>
    <div class="d-flex flex-column vote-controls">
        <a class="vote-up" v-bind:class="classes" v-bind:title="title('up')" v-on:click.prevent="voteUp">
            <i class="fa fa-caret-up fa-3x"></i>
        </a>

        <span class="votes-count">{{count}}</span>

        <a class="vote-down" v-bind:class="classes" v-bind:title="title('down')" v-on:click.prevent="voteDown">
            <i class="fa fa-caret-down fa-3x"></i>
        </a>


        <Favorites v-if="name === 'question'" v-bind:question="model"></Favorites>
       <accept-best-answer v-else v-bind:answer="model"></accept-best-answer>

    </div>

</template>

<script>
    import axios from 'axios'

    import AcceptBestAnswer from "./AcceptBestAnswer";
    import Favorites from "./Favorites";
    export default {
        name: "Vote",
        components: {AcceptBestAnswer , Favorites},
        props: ['name', 'model'],
        computed: {
            classes() {
                return this.signedIn ? '' : 'off';
            },
            endpoint(){
                return `/${this.name}s/${this.id}/vote`;
            }
        },
        data() {
            return {
                count: this.model.votes_count || 0,
                id: this.model.id
            }
        },

        methods: {
            title(voteType){
                let titles = {
                    up : `This ${this.name} is useful`,
                    down : `This ${this.name} is not useful`
                };
                return titles[voteType];
            },
            voteUp(){
                this._vote(1)
            },
            voteDown(){
                this._vote(-1)
            },
            _vote(vote){
                if (!this.signedIn) {
                    this.$toast.warning(`Please login to vote the ${this.name}` , "Warning" , {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    return;
                }
                axios.post(this.endpoint, {vote}).then(res=>{
                    this.$toast.success(res.data.message, "Success", {
                        timeout: 3000,
                        position: "bottomLeft"
                    });
                    this.count = res.data.votesCount;
                })
            }
        },
    }
</script>

<style scoped>

</style>