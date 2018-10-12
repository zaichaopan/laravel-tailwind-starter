<template>
    <div v-if="comments.length">
        <div v-for="(comment, index) in comments" :key="index">
            <comment-item :comment="comment"></comment-item>
        </div>
    </div>
</template>

<script>

export default {
  props: {
    fetchEndpoint: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      comments: []
    }
  },

  methods: {
    fetchComments () {
      axios.get(this.fetchEndpoint).then(({ data: { data } }) => {
        console.log(data)
        this.comments = data.data
      }).catch(err => {
        console.log(err)
      })
    }
  },
  mounted () {
    this.fetchComments()
  }

}
</script>

<style scoped>
</style>
