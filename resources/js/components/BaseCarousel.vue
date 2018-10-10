<template>
    <div class="carousel-siema">
        <div class="siema" ref="siema">
            <slot></slot>
        </div>
        <span class="siema-controls">
            <span
                class="border border-grey-light shadow flex h-10 w-10 justify-center rounded-full bg-white"
                :class="{invisable: !shouldSlide || isFirstRound}"
                aria-hidden="true"
                @click="siema.prev()"
            >
                <button type="button" class="flex justify-center outline-none" aria-busy="false">
                    <svg
                        viewBox="0 0 18 18"
                        role="img"
                        aria-label="Previous"
                        focusable="false"
                        style="height: 24px; width: 24px; display: block; fill: currentcolor;"
                    >
                        <path
                            d="m13.7 16.29a1 1 0 1 1 -1.42 1.41l-8-8a1 1 0 0 1 0-1.41l8-8a1 1 0 1 1 1.42 1.41l-7.29 7.29z"
                            fill-rule="evenodd"
                        ></path>
                    </svg>
                </button>
            </span>
            <span
                class="border border-grey-light shadow flex h-10 w-10 justify-center rounded-full bg-white"
                :class="{invisable: !shouldSlide || isLastRound}"
                aria-hidden="true"
                @click="siema.next()"
            >
                <button type="button" class="flex justify-center outline-none" aria-busy="false">
                    <svg
                        viewBox="0 0 18 18"
                        role="img"
                        aria-label="Next"
                        focusable="false"
                        style="height: 24px; width: 24px; display: block; fill: currentcolor;"
                    >
                        <path
                            d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z"
                            fill-rule="evenodd"
                        ></path>
                    </svg>
                </button>
            </span>
        </span>
    </div>
</template>

<script>
import Siema from 'siema'
export default {
  props: {
    totalItems: {
      type: Number,
      required: true
    },
    mobilePerPage: {
      type: Number,
      default: 1
    },
    desktopPerPage: {
      type: Number,
      default: 5
    }
  },
  data () {
    return {
      siema: {},
      selector: ''
    }
  },
  computed: {
    shouldSlide () {
      return this.siema.perPage < this.totalItems
    },
    isLastRound () {
      return (
        this.siema.perPage + this.siema.currentSlide === this.totalItems
      )
    },
    isFirstRound () {
      return this.siema.currentSlide === 0
    }
  },
  mounted () {
    this.selector = this.$refs.siema
    setTimeout(() => {
      this.siema = new Siema({
        selector: this.selector,
        duration: 200,
        easing: 'ease-out',
        perPage: {
          0: this.mobilePerPage,
          768: this.desktopPerPage
        },
        startIndex: 0,
        draggable: true,
        threshold: 20,
        loop: false
      })
    }, 50)
  }
}
</script>

<style lang="scss" scoped>
.carousel-siema {
  position: relative;
}
.siema-controls {
  position: absolute;
  z-index: 8;
  top: 50%;
  width: 105%;
  display: flex;
  justify-content: space-between;
  left: 50%;
  transform: translate(-50%, -50%);
}
.invisable {
  visibility: hidden;
}

img {
  width: 100%;
}
</style>
