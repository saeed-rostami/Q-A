<template>
    <div>
        <span class="text-muted"> {{ postDate }}</span>
        <div class="media">
            <a v-bind:href="user.url" class="pr-2">
                <img v-bind:src="user.avatar" alt="avatar">
            </a>
            <div class="media-body mt-2">
                <a v-bind:href="user.url">{{user.name}}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserInfo",
        props : ["model" , "label"],
        computed :{
            postDate(){
                return this.label + " " + this.model.created_date;
            }
        },
        data() {
            return {
                user: this.model.user
            }
        },
    }
</script>

<style scoped>

</style>