<template>
    <div>
        <a v-if="canAccept" title="Best Answer" v-bind:class="classes" v-on:click.prevent="create">
            <i class="fa fa-check fa-2x"></i>
        </a>

        <a v-if="accepted" title="This answer is best answer">
            <i class="fa fa-check fa-2x"></i>
        </a>
    </div>
</template>

<script>
    import axios from 'axios';
    import eventBus from '../EventBus';

    export default {
        name: "AcceptBestAnswer",
        props: ['answer'],
        data() {
            return {
                isBest: this.answer.is_best,
                id: this.answer.id
            }
        },
        computed: {
            canAccept() {
                return this.authorize('accept', this.answer);
            },
            accepted() {
                return !this.canAccept && this.isBest;
            },
            classes() {
                return [
                    'mt-3',
                    this.isBest ? 'vote-accepted' : '',

                ]
            }
        },
        methods: {
            create() {
                axios.post(`/answers/${this.id}/accept`).then(res => {
                    this.$toast.success(res.data.message, "Success", {
                        timeout: 3000,
                        position: "bottomLeft"
                    });
                    this.isBest = true;
                    eventBus.$emit('accepted', this.id)
                })
            }
        },
        created() {
            eventBus.$on('accepted', id => {
               this.isBest = id === this.id
            });
        }
    }
</script>

<style scoped>

</style>