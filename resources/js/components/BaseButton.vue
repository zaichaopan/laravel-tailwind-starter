<template>
    <div>
        <button :btn-type="btnType" :class="`${busy ? 'btn-spinner': ''} ${customClass}`">
            <slot></slot>
        </button>
    </div>
</template>

<script>
export default {
  props: {
    btnType: {
      type: String,
      default: 'button'
    },
    busy: {
      type: Boolean,
      defaut: false
    },
    customClass: {
      type: String,
      default: ''
    }
  }
}
</script>

<style scoped lang="scss">
.btn-spinner {
  color: transparent !important;
  pointer-events: none;
  position: relative;
}

.btn-spinner:after {
  animation: spinAround 500ms infinite linear;
  border: 2px solid #dbdbdb;
  border-radius: 290486px;
  border-right-color: transparent;
  border-top-color: transparent;
  content: "";
  display: block;
  width: 1em;
  height: 1em;
  position: relative;
  position: absolute;
  left: calc(50% - (1em / 2));
  top: calc(50% - (1em / 2));
  position: absolute !important;
}

@keyframes spinAround {
  from {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
</style>
