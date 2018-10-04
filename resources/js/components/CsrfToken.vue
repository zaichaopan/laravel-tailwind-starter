<template>
    <input type="text" name="_token" :value="csrf" hidden>
</template>

<script>
export default {
  data () {
    return {
      csrf: window.App.csrfToken
    }
  }
}
</script>
