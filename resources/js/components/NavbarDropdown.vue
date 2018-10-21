<template>
    <div class="navbar-dropdown relative" v-clickoutside="()=>open=false">
        <button
            role="button"
            type="button"
            class="px-4 flex items-center inline-block select-none flex items-center h-16 text-sm font-light capitalize text-sm text-grey-darker underline no-underline focus:outline-none"
            :class="btnClass"
            @click="open = !open"
        >
            <slot name="dropdown-toggle"></slot>
            <div class="ml-1">
                <base-icon icon-name="caret" :width="12" :height="12">
                    <icon-caret/>
                </base-icon>
            </div>
        </button>
        <div
            class="w-full lg:w-48 absolute z-50 shadow bg-white border border-b-0 overflow-hidden"
            :class="`${dropdownClass} pin-${alignment}`"
            v-show="open"
        >
            <slot name="dropdown-menu"></slot>
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

<style lang="postcss" scoped>
.navbar-dropdown-item {
  @apply flex items-center no-underline text-sm block px-4 py-4 border-b text-grey-darker whitespace-no-wrap;
}
.navbar-dropdown-item:hover {
  @apply bg-grey-lightest;
}
</style>
