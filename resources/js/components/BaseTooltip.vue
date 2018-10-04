<template>
    <div v-show="false">
        <slot></slot>
    </div>
</template>

<script>
import PopperTooltip from 'tooltip.js'

export default {
  props: {
    name: {
      type: String,
      require: true
    },
    placement: {
      type: String,
      default: 'top'
    },
    offset: {
      type: Boolean,
      default: false
    }
  },
  mounted () {
    document
      .querySelectorAll(`[data-tooltip-name=${this.name}]`)
      .forEach(elem => {
        new PopperTooltip(elem, {// eslint-disable-line no-new
          placement: this.placement,
          title: this.$el.innerHTML,
          offset: this.offset,
          html: true,
          template:
                    `<div class="tooltip" role="tooltip">
                        <div class="tooltip-arrow tooltip-arrow-html"></div>
                        <div class="tooltip-inner tooltip-inner-html"></div>
                     </div>
                     `
        })
      })
  }
}
</script>

<style lang="scss" scope>
.tooltip-inner.tooltip-inner-html {
  padding: 0 !important;
}
</style>
