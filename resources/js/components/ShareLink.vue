<template>
    <div>
        <button type="button"
                class="share-link"
                @click.prevent="share">

            <base-icon v-if="to==='twitter'"
                       :width="29"
                       :height="29"
                       :view-box-width="29"
                       :view-box-height="29"
                       v-tooltip:bottom="'Share on Twitter'">
                <icon-twitter />
            </base-icon>

            <base-icon v-if="to==='facebook'"
                       :width="29"
                       :height="29"
                       :view-box-width="29"
                       :view-box-height="29"
                       v-tooltip:bottom="'Share on Facebook'">
                <icon-facebook />
            </base-icon>
        </button>
    </div>
</template>

<script>
export default {
  props: {
    to: {
      type: String,
      required: true,
      validator (value) {
        return ['twitter', 'facebook'].includes(value)
      }
    },
    shareUrl: {
      type: String,
      default: document.URL
    },
    params: {
      type: Object,
      default () {
        return {}
      }
    }
  },
  computed: {
    buildLinkMethod () {
      return `build${this.to.charAt(0).toUpperCase() + this.to.slice(1)}ShareLink`
    }
  },
  methods: {
    share () {
      let link = this[this.buildLinkMethod]()
      window.open(link, '', 'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0')
    },
    buildTwitterShareLink () {
      return this.buildLink('http://twitter.com/share', 'url')
    },
    buildFacebookShareLink () {
      return this.buildLink('http://facebook.com/sharer/sharer.php', 'u')
    },
    buildLink (baseUrl, shareUrlParamName) {
      let params = { [shareUrlParamName]: this.shareUrl, ...this.params }
      let queryString = Object.keys(params)
        .map(param => `${param}=${encodeURIComponent(params[param])}`)
        .join('&')
      return `${baseUrl}?${queryString}`
    }
  }
}
</script>

<style scoped lang="scss">
.share-link {
  border: none;
  background: transparent;
  cursor: pointer;
  &:focus {
    outline: none;
  }
}
</style>
