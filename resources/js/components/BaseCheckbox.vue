
<template>
    <div class="checkbox-container flex items-center">
        <div>
            <label class="custom-checkbox">
                <input type="checkbox" v-model="checked" class="checkbox">
                <div class="slider">
                    <div class="slider-body"></div>
                    <div class="slider-ball"></div>
                </div>
            </label>
        </div>
        <div class="ml-2 text-sm">Use My current location</div>
    </div>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: false
    },
    text: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      checked: this.value
    }
  },
  watch: {
    checked () {
      this.$emit('input', this.checked)
    }
  }
}
</script>

<style scoped lang="scss">
.checkbox-container {
  position: relative;
  .custom-checkbox {
    cursor: pointer;
    -webkit-transform: translate(0, -50%);
    .slider-body {
      width: 48px;
      height: 30px;
      border-radius: 99999px;
      background-color: #e6e6e6;
    }
    .checkbox {
      display: none;
      &:checked + .slider .slider-ball {
        left: 18px;
        background-color: #fff;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
      }
      &:checked + .slider .slider-ball:before {
        content: "✔";
        color: #3d4852;
      }
      &:checked + .slider .slider-body {
        background-color: #3d4852;
      }
    }
    .slider-ball {
      position: absolute;
      display: flex;
      justify-content: center;
      align-items: center;
      top: 0px;
      left: 0px;
      width: 30px;
      height: 30px;
      border-radius: 99999px;
      border: 1px solid #dddd;
      background-color: #fff;
      -webkit-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
      &:before {
        content: "X";
        font-weight: bold;
        display: block;
        width: 30px;
        font-size: 0.8em;
        text-align: center;
        line-height: 26px;
        color: #222;
      }
    }
  }
}
</style>
