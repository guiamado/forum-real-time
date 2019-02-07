<template>
    <show-question
        :question="question"></show-question>
</template>

<script>
import ShowQuestion from './ShowQuestion'

export default {
    data() {
        return {
            question: {}
        }
    },
    components: {
        ShowQuestion,
    },
    created() {
        axios.get(`/api/question/${this.$route.params.slug}`)
            .then(res => this.question = res.data.data)
    }
}
</script>

<style>

</style>
