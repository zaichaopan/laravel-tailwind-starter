<template>
  <click-outside :do="handleClickOutside">
    <div class="dropdown">
      <button
        type="button"
        class="inline-block flex items-center focus:outline-none px-4 py-2 rounded text-white font-medium bg-blue hover:bg-blue-dark"
        @click="open = !open"
        ref="referenceElement"
      >
        <slot name="dropdown-trigger">
          <span class="mr-1">Dropdown</span>
        </slot>
        <span class="ml-2">
          <base-icon icon-name="caret" :width="10" :height="10">
            <icon-caret/>
          </base-icon>
        </span>
      </button>
      <div class="mt-px" :class="`z-${zIndex}`" v-show="open" ref="onPopper">
        <div class="bg-white shadow rounded border overflow-hidden">
          <slot name="dropdown-menu"></slot>
        </div>
      </div>
    </div>
  </click-outside>
</template>

<script>
import Popper from 'popper.js'
export default {
  props: {
    placement: {
      type: String,
      default: 'bottom-start'
    },
    zIndex: {
      type: Number,
      default: 10
    }
  },
  data () {
    return {
      open: false,
      popper: null
    }
  },
  watch: {
    open (value) {
      if (value) {
        this.popper = new Popper(this.$refs.referenceElement, this.$refs.onPopper, {
          placement: this.placement
        })
        return
      }

      this.popper.destroy()
    }
  },
  methods: {
    handleClickOutside () {
      if (this.open) {
        this.open = false
      }
    }
  }
}
</script>

<style lang="postcss">
.dropdown-item {
  @apply no-underline block px-4 py-3 border-b text-grey-darker bg-white text-sm;
}

.dropdown-item:hover {
  @apply bg-grey-lightest;
}
</style>
