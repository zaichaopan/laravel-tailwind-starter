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
    iconName: {
      type: String,
      default: 'box'
    },
    size: {
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
      width: 18,
      height: 18,
      viewBoxWidth: 18,
      viewBoxHeight: 18
    }
  },
  computed: {
    icon () {
      return `icon-${this.iconName}`
    }
  },
  methods: {
    setDimension (attribute = 'size') {
      let width = attribute === 'size' ? 'width' : `${attribute}Width`
      let height = attribute === 'size' ? 'height' : `${attribute}Height`

      if (typeof this[attribute] === 'string' && ~this[attribute].indexOf('x')) {
        ([this[width], this[height]] = this[attribute].split('x'))
        return
      }

      this[width] = this[attribute]
      this[height] = this[attribute]
    }
  },
  mounted () {
    this.setDimension('viewBox')
    this.setDimension()
  }
}
</script>

<style scoped lang="scss">
svg {
  display: inline-block;
  vertical-align: baseline;
  margin-bottom: -2px;
}
</style>
