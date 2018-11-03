<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    :width="width"
    :height="height"
    :viewBox="`0 0 ${viewBoxWidth} ${viewBoxHeight}`"
    :aria-labelledby="iconName"
    role="presentation"
  >
    <title :class="iconName" lang="en">{{iconName}} icon</title>
    <g :fill="iconColor">
      <component :is="icon"></component>
    </g>
  </svg>
</template>

<script>
export default {
  props: {
    // viewBoxWidth: {
    //   type: Number,
    //   default: 18
    // },
    // viewBoxHeight: {
    //   type: Number,
    //   default: 18
    // },
    iconName: {
      type: String,
      default: 'box'
    },
    width: {
      type: [Number, String],
      default: 18
    },
    height: {
      type: [Number, String],
      default: 18
    },
    viewBox: {
      type: [Number, String],
      default: 18
    },
    iconColor: {
      type: String,
      default: 'currentColor'
    }
  },
  data () {
    return {
      viewBoxWidth: 18,
      viewBoxHeight: 18
    }
  },
  computed: {
    icon () {
      return `icon-${this.iconName}`
    }
  },
  mounted () {
    if (typeof this.viewBox === 'string' && this.viewBox.indexOf('x')) {
      ([this.viewBoxWidth, this.viewBoxHeight] = this.viewBox.split('x'))
      return
    }

    this.viewBoxWidth = this.viewBox
    this.viewBoxWidth = this.viewBox
  }
}
</script>

<style scoped lang="scss">
svg {
  display: inline-block;
  vertical-align: baseline;
  margin-bottom: -2px; /* yes, I'm that particular about formatting */
}
</style>
