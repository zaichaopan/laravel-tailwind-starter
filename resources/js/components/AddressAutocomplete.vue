<template>
  <div class="w-full flex flex-col address-autocomplete">
    <div class="flex mb-3" v-if="includeUsingCurrentLocation">
      <!-- <label class="block">
        <input class="mr-2" type="checkbox" v-model="useCurrentLocation">
        <span class="text-sm">Use my current location</span>
      </label>-->
      <base-checkbox v-model="useCurrentLocation" text="Use my current location"></base-checkbox>
    </div>
    <div class="autocomplete-container relative mb-6" :class="customClass">
      <input
        :name="addressInputName"
        class="border border-grey-light appearance-none py-3 px-4 flex-1 w-full rounded"
        ref="pacInput"
        v-model="place.address"
        @keydown="handleKeyDown"
        :placeholder="placeholder"
        :disabled="gettingUseCurrentLocation"
        :required="requireAddress"
      >
      <span
        class="clear-icon p-2 cursor-pointer absolute pin-r"
        v-if="showClearIcon"
        @click="clearAddress"
      >X</span>
    </div>
    <div class="flex flex-wrap -mx-3 mb-4" v-show="displayGeo">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <input
          v-model="place.lat"
          id="lat"
          type="number"
          :name="latInputName"
          class="appearance-none w-full border rounded py-3 px-4 mb-3 focus:outline-none"
          :disabled="gettingUseCurrentLocation"
          placeholder="Latitude"
          step="any"
        >
      </div>
      <div class="w-full md:w-1/2 px-3">
        <input
          v-model="place.lng"
          id="lng"
          type="number"
          :name="lngInputName"
          class="appearance-none block w-full border rounded py-3 px-4 focus:outline-none"
          :disabled="gettingUseCurrentLocation"
          placeholder="Longitude"
          step="any"
        >
      </div>
    </div>
  </div>
</template>

<script>
import { load } from '@zaichaopan/load-script'

export default {
  props: {
    value: {
      type: Object,
      default: () => {
        return {
          address: '',
          lat: 0.0,
          lng: 0.0
        }
      }
    },
    customClass: {
      type: String,
      required: false
    },
    placeholder: {
      type: String,
      default: 'Anywhere'
    },
    required: {
      type: Boolean,
      default: false
    },
    requireAddress: {
      type: Boolean,
      default: false
    },
    displayGeo: {
      type: Boolean,
      defalt: false
    },
    includeUsingCurrentLocation: {
      type: Boolean,
      default: false
    },
    latInputName: {
      type: String,
      default: 'lat'
    },
    lngInputName: {
      type: String,
      default: 'lng'
    },
    addressInputName: {
      type: String,
      default: 'address'
    }
  },
  data () {
    return {
      dropdown: null,
      input: null,
      googoleMaps: null,
      useCurrentLocation: false,
      gettingUseCurrentLocation: false,
      place: {
        lat: this.value.lat,
        lng: this.value.lng,
        address: this.shortAddress(this.value.address)
      }
    }
  },
  computed: {
    showClearIcon () {
      return this.place.address.length > 0
    }
  },
  watch: {
    useCurrentLocation (value) {
      if (value) {
        this.getUserCurrentLocation()
      }
    },
    value: {
      handler: function (val) {
        this.place = val
      },
      deep: true,
      immediate: true
    },
    place: {
      handler: function (val) {
        val.lat = Number(val.lat)
        val.lng = Number(val.lng)
        this.$emit('input', val)
      },
      deep: true
    }
  },
  methods: {
    autocomplete () {
      this.input = this.$refs.pacInput
      this.dropdown = new this.googleMaps.places.Autocomplete(this.input)
      this.dropdown.addListener('place_changed', () => {
        let place = this.dropdown.getPlace()
        let address = this.input.value
        this.input.value = this.shortAddress(address)
        let lat = place.geometry.location.lat()
        let lng = place.geometry.location.lng()
        this.$emit('input', { address, lat, lng })
      })
    },
    handleKeyDown (e) {
      if (e.keyCode === 13) e.preventDefault()
    },
    clearAddress () {
      this.place.address = ''
      this.$emit('input', {
        address: '',
        lat: '',
        lng: ''
      })
    },
    shortAddress (address) {
      let addArr = address.split(',')
      if (addArr.length < 5) {
        return address
      }
      addArr.length = 3
      return addArr.join(',')
    },
    getUserCurrentLocation () {
      if (!navigator.geolocation) {
        console.log('Browser doesn\'t support Geolocation')
        return
      }

      this.gettingUseCurrentLocation = true
      navigator.geolocation.getCurrentPosition(({ coords: { latitude: lat, longitude: lng } }) => {
        let geocoder = new this.googleMaps.Geocoder()
        geocoder.geocode({ 'location': { lat, lng } }, (results, status) => {
          this.gettingUseCurrentLocation = false

          if (status !== 'OK') {
            console.lg('Gecoder failed')
            return
          }

          let [result] = results

          if (!result) {
            console.lg('Gecoder failed')
            return
          }

          let { formatted_address: address } = result
          this.$emit('input', { address, lat, lng })

          this.input.value = this.shortAddress(address)
        })
      }, (err) => {
        this.gettingUseCurrentLocation = false
        console.log(err)
      })
    }
  },
  async mounted () {
    try {
      let google = await load({
        src: 'https://maps.googleapis.com/maps/api/js',
        callbackName: 'callback',
        resolve: 'google',
        params: {
          key: window.App.googleMapKey,
          libraries: 'places'
        }
      })
      this.googleMaps = google.maps
      this.autocomplete()
    } catch (e) {
      console.log(e)
    }
  }
}
</script>

<style  lang="scss">
.address-autocomplete {
  input:disabled {
    background: #f1f5f8;
  }
}
.pac-container {
  z-index: 10060 !important;
  border-radius: 5px;
  padding: 5px;
}
.search-icon {
  left: 8px;
}
.search-input {
  padding-left: 40px;
  &:focus {
    outline: none;
    border: none;
  }
}
.pac-item {
  border: none;
  padding: 5px;
  &:hover {
    background-color: #cdeeeb;
  }
}
.pac-item-selected {
  background-color: #cdeeeb;
}

.clear-icon {
  top: 5px;
}
</style>
