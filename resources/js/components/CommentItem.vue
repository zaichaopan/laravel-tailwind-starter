<template>
  <div class="border-l border-grey pl-2">
    <div>{{ comment.user.name}} say ... {{comment.body}}</div>
    <div v-if="comment.comments">
      <comment-item
        v-for="(item, index) in comment.comments"
        :comment="item"
        :key="index"
        :nesting="nesting+1"
      ></comment-item>
    </div>
  </div>
</template>

<script>
export default {
  name: 'comment-item',
  props: {
    comment: {
      type: Object,
      required: true
    },
    nesting: {
      type: Number,
      default: 1
    }
  }
}
</script>

<style scoped>
</style>
