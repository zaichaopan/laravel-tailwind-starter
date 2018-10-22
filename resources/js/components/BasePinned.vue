<template>
    <div>
        <slot>
            <slot></slot>
        </slot>
    </div>
</template>

<script>
import { throttle } from 'lodash'

export default {
  mounted () {
    let el = this.$el
    let originalOffsetTop = this.$el.offsetTop
    window.addEventListener(
      'scroll',
      throttle(function () {
        el.classList[ window.scrollY >= originalOffsetTop ? 'add' : 'remove' ]('is-fixed-to-top')
      }))
  }
}
</script>

<style scoped lang="css">
.is-fixed-to-top {
  position: fixed;
  width: 100%;
  z-index: 10;
  top: 0;
}
</style>
