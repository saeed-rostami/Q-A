<template>

    <a title="Add Favorite" v-bind:class="classes"
       v-on:click.prevent="toggle"
    >
        <i class="fa fa-star fa-2x"></i>
        <span class="favorites-count">{{count}}</span>
    </a>

</template>

<script>
    import axios from 'axios';
    export default {
        name: "Favorites",
        props: ["question"],
        data() {
            return {
                isFavorited: this.question.is_favorited,
                count: this.question.favorites_count,
                id: this.question.id,
            }
        },
        computed:{
            classes(){
                return [
                    'favorite', 'mt-3',
                    ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '')
                ]
            },
            endPoint(){
               return `/questions/${this.id}/favorites`;
            }
        },
        methods:{
            toggle(){
                if (! this.signedIn){
                    this.$toast.warning('Please log in' , "Warning" , {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    return;
                }
                this.isFavorited ? this.destroy() : this.create();
            },
            destroy(){
                axios.delete(this.endPoint).then(res => {
                    this.count--;
                    this.isFavorited = false;
                })
            },
            create(){
                axios.post(this.endPoint).then(res => {
                    this.count++;
                    this.isFavorited = true;
                })
            }
        },
    }
</script>

<style scoped>

</style>