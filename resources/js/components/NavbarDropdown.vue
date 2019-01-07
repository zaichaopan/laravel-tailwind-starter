<template>
  <div class="navbar-dropdown relative" v-clickoutside="()=>open=false">
    <button
      role="button"
      type="button"
      class="nav-dropdown-btn focus:outline-none"
      :class="btnClass"
      @click="open = !open"
    >
      <slot name="dropdown-toggle" class="test"></slot>
      <div class="ml-1" v-if="displayCaret">
        <base-icon icon-name="caret" :width="12" :height="12">
          <icon-caret/>
        </base-icon>
      </div>
    </button>
    <div
      class="w-full lg:w-64 absolute z-50 shadow bg-white border border-b-0 rounded shadow-md"
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
      type: String,
      default: 'dropdown'
    },
    btnClass: {
      type: String
    },
    alignment: {
      type: String,
      default: 'l'
    },
    displayCaret: {
      type: Boolean,
      default: false
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
.nav-dropdown-btn {
  @apply px-4 flex items-center inline-block select-none flex items-center h-16 text-sm font-light capitalize text-sm text-grey-darker underline no-underline;
}

.navbar-dropdown-item {
  @apply flex flex-col no-underline text-sm px-4 py-3 border-b text-grey-darker whitespace-no-wrap;
}

@screen lg {
  .dropdown {
    margin-top: .75rem;
  }
  .dropdown::after {
    content: "";
    height: 1rem;
    width: 1rem;
    border: 1px solid #dae1e7;
    position: absolute;
    top: 0;
    right: 0;
    transform: translateY(-50%) translateX(-150%) rotate(45deg);
    background: white;
    border-bottom: navajowhite;
    border-right: none;
    z-index: 1;
  }
}
</style>
