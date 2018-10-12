
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

// Register directives
require('./directives/')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app-nav', require('./components/AppNav.vue'))
Vue.component('base-dropdown', require('./components/BaseDropdown.vue'))
Vue.component('base-tooltip', require('./components/BaseTooltip.vue'))
Vue.component('base-dropzone', require('./components/BaseDropzone.vue'))
Vue.component('base-icon', require('./components/BaseIcon.vue'))
Vue.component('multi-image-uploader', require('./components/MultiImageUploader.vue'))
Vue.component('file-input', require('./components/FileInput.vue'))
Vue.component('share-link', require('./components/ShareLink.vue'))
Vue.component('icon-bell', require('./components/icons/IconBell.vue'))
Vue.component('icon-chat', require('./components/icons/IconChat.vue'))
Vue.component('icon-caret', require('./components/icons/IconCaret.vue'))
Vue.component('icon-uploader', require('./components/icons/IconUploader.vue'))
Vue.component('icon-twitter', require('./components/icons/IconTwitter.vue'))
Vue.component('icon-facebook', require('./components/icons/IconFacebook.vue'))
Vue.component('icon-jpg', require('./components/icons/IconJpg.vue'))
Vue.component('icon-txt', require('./components/icons/IconTxt.vue'))
Vue.component('icon-pdf', require('./components/icons/IconPdf.vue'))
Vue.component('icon-excel', require('./components/icons/IconExcel.vue'))
Vue.component('icon-doc', require('./components/icons/IconDoc.vue'))
Vue.component('icon-png', require('./components/icons/IconPng.vue'))
Vue.component('icon-file-uploader', require('./components/icons/IconFileUploader.vue'))
Vue.component('csrf-token', require('./components/CsrfToken.vue'))

// place
Vue.component('place-form', require('./components/places/PlaceForm.vue'))
Vue.component('address-autocomplete', require('./components/AddressAutocomplete.vue'))
Vue.component('click-outside', require('./components/ClickOutside.vue'))
Vue.component('autosize-textarea', require('./components/AutosizeTextarea.vue'))
Vue.component('base-button', require('./components/BaseButton.vue'))
Vue.component('base-checkbox', require('./components/BaseCheckbox.vue'))
Vue.component('base-carousel', require('./components/BaseCarousel.vue'))

Vue.component('comment-list', require('./components/CommentList.vue'))
Vue.component('comment-item', require('./components/CommentItem.vue'))
/* eslint-disable */
const app = new Vue({
    el: '#app'
})
