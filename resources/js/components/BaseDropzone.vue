<template>
    <div :class="zoneClass"
         @click="handleClicked">
        <slot></slot>
    </div>
</template>

<script>
export default {
  props: {
    zoneClass: {
      type: String,
      default: 'drop-zone'
    },
    highlightClass: {
      type: String,
      default: 'highlight'
    }
  },
  methods: {
    preventDefault (e) {
      e.preventDefault()
      e.stopPropagation()
    },
    highlight (e) {
      this.dropArea.classList.add(this.highlightClass)
    },
    unhighlight (e) {
      this.dropArea.classList.remove(this.highlightClass)
    },
    handleDrop ({ dataTransfer: { files } }) {
      this.handleFileAdded(files)
    },
    handleFileAdded (files) {
      this.$emit('files:added', files)
    },
    handleClicked (e) {
      this.$emit('area:clicked', e.target)
    }
  },
  mounted () {
    this.dropArea = this.$el;
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => this.dropArea.addEventListener(e, this.preventDefault));
    ['dragenter', 'dragover'].forEach(e => this.dropArea.addEventListener(e, this.highlight));
    ['dragleave', 'drop'].forEach(e => this.dropArea.addEventListener(e, this.unhighlight))
    this.dropArea.addEventListener('drop', this.handleDrop)
  }
}
</script>

<style lang="scss" scoped>
.drop-zone {
  max-width: 100%;
  padding: 10px;
  border-radius: 5px;
  min-height: 200px;
  border: 1px dashed #dedede;
  cursor: pointer;
}

.highlight {
  border-color: #8795a1;
  background: #f8fafc;
}
</style>
