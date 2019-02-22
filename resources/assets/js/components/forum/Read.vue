<template>
    <div v-if="question">
        <edit-question
            v-if="editing"
            :question="question"></edit-question>
        <show-question
            v-else
            :question="question"
            ></show-question>
        <v-container>
            <replies :question="question"></replies>
            <CreateReply :questionSlug="question.slug"></CreateReply>    
        </v-container>
    </div>
</template>

<script>
import ShowQuestion from './ShowQuestion'
import EditQuestion from './EditQuestion'
import Replies from '../reply/Replies'
import CreateReply from '../reply/CreateReply'

export default {
    data() {
        return {
            question: null,
            editing: false,
        }
    },
    components: {
        ShowQuestion,
        EditQuestion,
        Replies,
        CreateReply,
    },
    created() {
        this.listen()
        this.getQuestion()
    },
    methods: {
        listen() {
            EventBus.$on('startEditing', () => {
                this.editing = true
            })
            EventBus.$on('cancelEditing', () => {
                this.editing = false
            })
        },
        getQuestion() {
            axios.get(`/api/question/${this.$route.params.slug}`)
            .then(res => this.question = res.data.data)
        }
    }
}
</script>

<style>

</style>
