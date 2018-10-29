<template>
  <div class="flex flex-col">
    <div class="flex">
      <div class="avatar flex-no-shrink">
        <img
          src="https://placeimg.com/640/480/people"
          :alt="comment.user.name"
          class="rounded"
          :class="`${nesting > 1 ? 'h-10 w-10': 'h-12 w-12'}`"
        >
      </div>
      <div class="flex flex-col flex-1">
        <div class="flex flex-col px-2 mb-2">
          <div
            class="text-grey-darker text-sm"
          >{{ comment.user.name}}&nbsp;&bull;&nbsp;{{ comment.created_at}}</div>
          <div class="py-2">{{comment.body}}</div>
          <div class="text-grey-darker text-sm">
            <button
              class="text-grey-darker"
              type="button"
              @click="toggleCommentForm = !toggleCommentForm"
            >Reply</button>&nbsp;&bull;&nbsp;
            <button class="text-grey-darker" type="button">Like</button>
          </div>
          <div v-if="toggleCommentForm" class="flex flex-col">
            <form class="pt-2 flex flex-col">
              <div>
                <autosize-textarea
                  v-model="newCommentBody"
                  :required="true"
                  custom-class="w-full border border-grey rounded p-2"
                  placeholder="Add your comment..."
                  :autofocus="true"
                ></autosize-textarea>
              </div>
              <div class="my-2 flex justify-end">
                <button
                  type="reset"
                  class="bg-white text-grey-dark font-bold py-2 px-4 rounded mr-2 text-sm"
                >Cancel</button>
                <button
                  class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded text-sm"
                >Reply</button>
              </div>
            </form>
          </div>
        </div>
        <div v-if="comment.comments" class="px-2">
          <comment-item
            v-for="(item, index) in comment.comments"
            :comment="item"
            :key="index"
            :nesting="nesting+1"
          ></comment-item>
        </div>
      </div>
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
  },
  data () {
    return {
      toggleCommentForm: false,
      newCommentBody: ''
    }
  }
}
</script>

<style scoped>
</style>
