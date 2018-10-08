<template>
  <div class="place-form">
    <form method="post" @submit.prevent="submit" :action="action" name="placeForm">
      <csrf-token/>
      <input v-if="place" type="hidden" name="_method" value="PUT">
      <div class="my-4">
        <address-autocomplete
          v-model="form.place"
          custom-class="w-full flex flex-row"
          placeholder="Where is the spot located?"
          :include-using-current-location="true"
          :require-address="true"
          :display-geo="true"
        ></address-autocomplete>
      </div>
      <div class="my-4">
        <autosize-textarea
          name="description"
          v-model="form.description"
          custom-class="border border-grey-light w-full px-2 py-3 rounded"
          :required="true"
          placeholder="How do you describe this place?"
        ></autosize-textarea>
      </div>
      <div class="my-8">
        <multi-image-uploader
          :upload-endpoint="uploadImageEndpoint"
          :delete-endpoint="deleteImageEndpoint"
          file-name="image"
          v-model="form.images"
        ></multi-image-uploader>
        <input
          v-for="(image, index) in form.images"
          type="text"
          name="images[]"
          :value="image.path"
          hidden
          :key="index"
        >
      </div>
      <div class="my-8 text-center">
        <base-button
          :busy="busy"
          @click.native="baseBtnCalled"
          btn-type="submit"
          custom-class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          <span>Submit</span>
        </base-button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: {
    action: {
      type: String,
      required: true
    },
    uploadImageEndpoint: {
      type: String,
      default: ''
    },
    deleteImageEndpoint: {
      type: String,
      default: ''
    },
    place: {
      type: Object,
      default () {
        return null
      }
    },
    errors: {
      type: Array,
      default () {
        return []
      }
    }
  },
  data () {
    return {
      busy: false,
      form: {
        place: {
          lat: '',
          lng: '',
          address: ''
        },
        description: '',
        images: []
      }
    }
  },
  methods: {
    initializeForm () {
      if (this.place) {
        this.form.description = this.place.description
        this.form.images = this.place.images
        this.form.place.address = this.place.address
        this.form.place.lat = this.place.lat
        this.form.place.lng = this.place.lng
      }
    },
    submit () {
      this.busy = true
      document.forms.placeForm.submit()
    }
  },
  mounted () {
    this.initializeForm()
  }
}
</script>
