<template>
    <div class="place-form">

        <form method="post">
            <csrf-token />

            <div class="my-4">
                <address-autocomplete v-model="form.place"
                                      custom-class="w-full flex flex-row"
                                      placeholder="Where is the spot located?"
                                      :include-using-current-location="true"
                                      :require-address="true">
                </address-autocomplete>
            </div>

            <div class="my-4">
                <autosize-textarea name="descripiton"
                                   v-model="form.descripiton"
                                   custom-class="border border-grey-light w-full px-2 py-3 rounded"
                                   :required="true"
                                   placeholder="How do you describe this place?">
                </autosize-textarea>
            </div>

            <div class="my-8">
                <multi-image-uploader :upload-endpoint="uploadImageEndpoint"
                                      :delete-endpoint="deleteImageEndpoint"
                                      file-name="image">
                </multi-image-uploader>
            </div>

            <div class="my-8 text-center">
                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded">
                    Button
                </button>
            </div>
        </form>

    </div>
</template>
<script>
export default {
  props: {
    uploadImageEndpoint: {
      type: String,
      default: ''
    },
    deleteImageEndpoint: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
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
  }
}
</script>
