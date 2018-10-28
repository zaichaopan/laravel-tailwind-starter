<template>
  <div v-if="comments.total">
    <div v-for="(comment, index) in comments.data" :key="index">
      <comment-item :comment="comment"></comment-item>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    comments: {
      type: Object,
      required: true
    }
  },
  data () {
    return {

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
  }

}
</script>

<style scoped>
</style>
