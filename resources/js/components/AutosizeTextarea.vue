<template>
  <textarea
    :name="name"
    ref="autosize"
    :class="customClass"
    v-model="body"
    :placeholder="placeholder"
    :rows="rows"
    :required="required"
    @input="handleInputChange"
    :autofocus="autofocus"
  ></textarea>
</template>

<script>
import autosize from 'autosize'
export default {
  props: {
    name: {
      type: String,
      default: 'body'
    },
    required: {
      type: Boolean,
      default: true
    },
    placeholder: {
      type: String,
      default: 'Say something nice...'
    },
    rows: {
      type: Number,
      default: 3
    },
    value: {
      type: String,
      default: ''
    },
    customClass: {
      type: String,
      default: ''
    },
    autofocus: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      body: this.value
    }
  },
  watch: {
    value () {
      this.body = this.value
    }
  },
  methods: {
    handleInputChange () {
      this.$emit('input', this.body)
    }
  },
  mounted () {
    autosize(this.$refs.autosize)
  }
}
</script>
