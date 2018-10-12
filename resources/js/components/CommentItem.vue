<template>
    <div>
        <hr>
        <div>{{comment.body}}</div>
        <div v-if="comment.children">
            <comment-item v-for="(child, index) in comment.children" :comment="child" :key="index"></comment-item>
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
    }
  }
}
</script>

<style scoped>
</style>
