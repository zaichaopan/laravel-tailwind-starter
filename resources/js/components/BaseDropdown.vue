<template>
    <div class="relative"
         v-clickoutside="()=>open=false">
        <button role="button"
                type="button"
                class="inline-block select-none"
                :class="btnClass"
                @click="open = !open">
            <slot name="link"></slot>
        </button>
        <div class="absolute"
             :class="`${dropdownClass} pin-${alignment} z-${zIndex}`"
             v-show="open">
            <slot name="dropdown"></slot>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    dropdownClass: {
      type: String
    },
    btnClass: {
      type: String
    },
    alignment: {
      type: String,
      default: 'l'
    },
    zIndex: {
      type: Number,
      default: 0
    }
  },
  data () {
    return {
      open: false
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
