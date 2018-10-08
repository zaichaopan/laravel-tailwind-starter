<template>
  <base-dropzone @files:added="handleFilesAdded" @area:clicked="handleAreaClicked">
    <form class="upload-form">
      <input
        type="file"
        id="fileElem"
        ref="input"
        multiple
        accept="image/*"
        @change="({ target: { files }}) => handleFilesAdded(files)"
      >
      <div class="title" v-if="!images.length">
        <div class="p-1">
          Drop images here or
          <span class="text-blue hover:underline">click</span>to upload
        </div>
      </div>
      <div class="feedback">{{ feedBack}}</div>
      <div class="preview-area flex flex-wrap" ref="previewContainer" v-if="images.length">
        <div
          v-for="(item, index) in images"
          class="image-container w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4"
          :key="index"
        >
          <img :src="item.src || item.url ||  previewImage(item.file, index)">
          <a
            v-if="item.uploaded || item.path"
            class="rm-btn"
            role="button"
            @click="removeImage(item, index)"
          >&times;</a>
          <div class="progress" v-if="item.uploading">
            <div class="progress-bar" :style="`width:${item.progress}`"></div>
          </div>
        </div>
      </div>
    </form>
  </base-dropzone>
</template>

<script>
export default {
  props: {
    uploadEndpoint: {
      type: String,
      default: null
    },
    deleteEndpoint: {
      type: String,
      default: null
    },
    fileName: {
      type: String,
      default: 'image'
    },
    maxFileSize: {
      type: Number,
      default: 2 // 2M; 2000,000 byte
    },
    maxFiles: {
      type: Number,
      default: 8
    },
    value: {
      type: Array,
      default () {
        return []
      }
    },
    defaultImages: {
      type: Array,
      default () {
        return []
      }
    }
  },
  data () {
    return {
      feedBack: '',
      images: this.value
    }
  },
  watch: {
    images () {
      this.$emit('input', this.images)
    },
    value () {
      this.images = this.value
    }
  },
  methods: {
    handleFilesAdded (files) {
      this.validateInput(files) && this.upload(files)
    },
    handleAreaClicked (target) {
      let ignoredNodes = ['IMG', 'BUTTON', 'A']
      !ignoredNodes.includes(target.nodeName) && this.$refs.input.click()
    },
    previewImage (file, index) {
      let reader = new FileReader()
      this.$nextTick(() => {
        let previewContainer = this.$refs.previewContainer
        let images = previewContainer.querySelectorAll('img')
        reader.readAsDataURL(file)
        reader.onload = e => { images[index].src = e.target.result }
      })
    },
    upload (files) {
      let images = [...files].map(file => {
        return {
          file,
          uploaded: false,
          uploading: false,
          path: null,
          name: null,
          src: null,
          progress: '0%'
        }
      })

      if (this.uploadEndpoint === null) {
        return
      }

      images.forEach((image, index) => {
        if (image.uploaded) return
        let formData = new FormData()
        formData.append(this.fileName, image.file)
        image.uploading = true
        window.axios
          .post(this.uploadEndpoint, formData, {
            onUploadProgress: e =>
              (image.progress = `${e.loaded * 100.0 / e.total}%`)
          })
          .then(({ data: { data } }) => {
            image.src = data.url
            image.path = data.path
            image.uploading = false
            image.uploaded = true
            image.name = data.name
            this.images.push(image)
          })
          .catch(err => { // eslint-disable-line  handle-callback-err
            this.feedBack = 'Something went wrong! Please try it again !'
            image.uploading = false
          })
      })
    },
    removeImage (image, index) {
      if (image.path === null) {
        return
      }

      window.axios
        .delete(this.deleteEndpoint, { data: { path: image.path } })
        .then(res => this.images.splice(index, 1))
        .catch(err => { // eslint-disable-line  handle-callback-err
          this.feedBack = 'Something went wrong! Please try it again!'
        })
    },
    validateInput (files) {
      if (files.length + this.images.length > this.maxFiles) {
        this.feedBack = `You can only upload ${this.maxFiles} images`
        return false
      }

      let maxSizeInByte = this.maxFileSize * 1000000

      if ([...files].some(({ size }) => size > maxSizeInByte)) {
        this.feedBack = `Please makse sure your file size is less than ${this.maxFileSize}M.`
        return false
      }

      this.feedBack = ''
      return true
    }
  }
}
</script>
<style lang="scss" scoped>
.upload-form {
  #fileElem {
    display: none;
  }

  .title {
    text-align: center;
    color: #606f7b;

    svg {
      fill: currentColor;
    }
  }

  .feedback {
    font-size: 0.8rem;
    padding: 0.5rem;
    color: #e3342f;
    text-align: center;
  }

  p {
    margin-top: 0;
  }

  .progress {
    border: 1px solid #f1f5f8;
    margin-top: 0.5rem;
    .progress-bar {
      height: 0.8rem;
      background: #6cb2eb;
    }
  }

  .preview-area {
    padding: 1rem;

    .image-container {
      display: flex;
      flex-direction: column;
      position: relative;
      padding: 1rem;

      align-content: center;

      img {
        border-radius: 0.2rem;
        width: 100%;
        min-height: 150px;
        object-fit: cover;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
      }
      .rm-btn {
        position: absolute;
        top: 22px;
        right: 22px;
        height: 22px;
        width: 22px;
        color: #ffff;
        text-decoration: none;
        font-size: 1.5rem;
        line-height: 0.8;
        background: rgba(0, 0, 0, 0.2);
        border: none;
        display: inline-block;
        text-align: center;
        border-radius: 9999px;
        cursor: pointer;
        &:focus {
          outline: none;
        }
      }
    }
  }
}
</style>
