<template>
    <div v-show="isVisible" :class="customClass">
        <slot></slot>
    </div>
</template>

<script>
import inViewport from 'in-viewport'
export default {
  props: {
    whenHidden: {
      type: String,
      required: true
    },
    customClass: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      isVisible: false
    }
  },
  methods: {
    checkDisplay () {
      this.isVisible = !inViewport(document.querySelector(this.whenHidden))
    }
  },
  mounted () {
    window.addEventListener('scroll', this.checkDisplay, { passive: true })
  }
}
</script>

<style scoped>
</style>
