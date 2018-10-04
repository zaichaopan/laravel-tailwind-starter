<template>
    <svg xmlns="http://www.w3.org/2000/svg"
         :width="width"
         :height="height"
         :viewBox="`0 0 ${viewBoxWidth} ${viewBoxHeight}`"
         :aria-labelledby="iconName"
         role="presentation">
        <title :class="iconName"
               lang="en">{{iconName}} icon
        </title>
        <g :fill="iconColor">
            <slot />
        </g>
    </svg>
</template>

<script>
export default {
  props: {
    viewBoxWidth: {
      type: Number,
      default: 18
    },
    viewBoxHeight: {
      type: Number,
      default: 18
    },
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
    iconColor: {
      type: String,
      default: 'currentColor'
    }
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
