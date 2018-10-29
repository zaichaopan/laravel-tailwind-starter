
<template>
    <form class="pt-2">
        <autosize-textarea
            v-model="body"
            :required="true"
            custom-class="w-full border border-grey rounded p-2"
            placeholder="Add your comment..."
        ></autosize-textarea>
    </form>
</template>

<script>
export default {
  props: {
    show: {
      type: Boolean,
      default: true
    }
    // action: {
    //   type: String,
    //   required: true
    // }
  },
  data () {
    return {
      body: ''
    }
  }

}
</script>

<style scoped>
</style>
