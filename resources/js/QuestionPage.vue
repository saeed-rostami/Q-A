<template>
    <div>
        <question v-bind:question="question"></question>
        <answers v-bind:question="question"></answers>
    </div>
</template>

<script>
    import Answers from "./components/Answers";
    import Question from "./components/Question";

    export default {
        name: "QuestionPage",
        components: {Answers , Question},
        props: ['question'],
    }
</script>

<style scoped>

</style>
