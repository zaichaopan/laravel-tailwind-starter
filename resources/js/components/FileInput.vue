<template>
    <div class="file-input-container">
        <label for="file"
               class="flex text-muted pointer items-center border border-grey-light items-stretch">

            <div class="border-grey-light border-r flex py-2 flex-1 items-center px-2 cursor-pointer">
                <base-icon :view-box-width="33.293"
                           :view-box-height="33.293"
                           :width="24"
                           :height="24">
                    <component :is="extension"></component>
                </base-icon>
                <div class="flex-1 px-2 text-sm">
                    {{ message }}
                </div>
            </div>
            <div class="px-3 py-2 text-xs cursor-pointer uppercase text-white bg-black leading-loose">
                Browse
            </div>
        </label>
        <input :name="name"
               type="file"
               id="file"
               :accept="accept"
               hidden
               @change="handleInputChanged">
    </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default: 'file'
    },
    placeholder: {
      type: String,
      default: 'Choose a file ...'
    },
    accept: {
      type: String,
      default: '*'
    }
  },
  data () {
    return {
      file: null
    }
  },
  computed: {
    message () {
      return this.file ? this.file.name : this.placeholder
    },
    extension () {
      let fileExtension = this.file ? this.file.name.split('.').pop().toLowerCase() : 'file-uploader'
      return `icon-${fileExtension}`
    }
  },
  methods: {
    handleInputChanged ({ target: { files } }) {
      [this.file] = files
      this.$emit('file:changed', this.file)
    }
  }
}
</script>

<style scoped lang="scss">
.file-input-container {
  label {
    // border: 1px solid #ddd;
    // padding: 5px 10px;
    border-radius: 5px;
    span {
      //   margin: -5px -10px;
      background-color: #e9ecef;
      border-bottom-right-radius: 5px;
      border-top-right-radius: 5px;
    }
  }
}
</style>
