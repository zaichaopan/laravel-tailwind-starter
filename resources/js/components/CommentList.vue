<template>
  <div class="flex flex-col">
    <div class="flex pt-4 mb-10" id="comment-form">
      <div class="avatar flex-no-shrink">
        <img src="https://placeimg.com/640/480/people" class="rounded h-12 w-12">
      </div>
      <div class="flex flex-col flex-1 px-2">
        <form class="">
          <div>
            <autosize-textarea
              v-model="newCommentBody"
              :required="true"
              custom-class="w-full border border-grey rounded p-2"
              placeholder="Add your comment..."
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
    <div v-if="comments.total" class="#comment-list">
      <div v-for="(comment, index) in comments.data" :key="index" class="flex mb-2">
        <comment-item :comment="comment"></comment-item>
      </div>
    </div>
    <conditional-element when-hidden="#comment-form" custom-class="sticky pin-b pin-r ml-auto  p-2">
      <a
        class="flex justify-center items-center rounded-full h-16 w-16 inline-block text-sm px-4 py-2 leading-none rounded bg-blue hover:bg-blue-dark"
        href="#comment-form"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          version="1.1"
          id="Capa_1"
          x="0px"
          y="0px"
          viewBox="0 0 491.86 491.86"
          height="20"
          xml:space="preserve"
        >
          <g>
            <g>
              <path
                style="fill: rgb(255, 255, 255);"
                d="M465.167,211.614H280.245V26.691c0-8.424-11.439-26.69-34.316-26.69s-34.316,18.267-34.316,26.69v184.924H26.69    C18.267,211.614,0,223.053,0,245.929s18.267,34.316,26.69,34.316h184.924v184.924c0,8.422,11.438,26.69,34.316,26.69    s34.316-18.268,34.316-26.69V280.245H465.17c8.422,0,26.69-11.438,26.69-34.316S473.59,211.614,465.167,211.614z"
              ></path>
            </g>
          </g>
        </svg>
      </a>
    </conditional-element>
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
      newCommentBody: ''
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
