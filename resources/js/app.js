
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

window.Vue.component('app-nav', require('./components/AppNav.vue'))
window.Vue.component('base-dropdown', require('./components/BaseDropdown.vue'))
window.Vue.component('base-tooltip', require('./components/BaseTooltip.vue'))
window.Vue.component('base-dropzone', require('./components/BaseDropzone.vue'))
window.Vue.component('base-icon', require('./components/BaseIcon.vue'))
window.Vue.component('multi-image-uploader', require('./components/MultiImageUploader.vue'))
window.Vue.component('file-input', require('./components/FileInput.vue'))
window.Vue.component('share-link', require('./components/ShareLink.vue'))
window.Vue.component('icon-bell', require('./components/icons/IconBell.vue'))
window.Vue.component('icon-chat', require('./components/icons/IconChat.vue'))
window.Vue.component('icon-caret', require('./components/icons/IconCaret.vue'))
window.Vue.component('icon-uploader', require('./components/icons/IconUploader.vue'))
window.Vue.component('icon-twitter', require('./components/icons/IconTwitter.vue'))
window.Vue.component('icon-facebook', require('./components/icons/IconFacebook.vue'))
window.Vue.component('icon-jpg', require('./components/icons/IconJpg.vue'))
window.Vue.component('icon-txt', require('./components/icons/IconTxt.vue'))
window.Vue.component('icon-pdf', require('./components/icons/IconPdf.vue'))
window.Vue.component('icon-excel', require('./components/icons/IconExcel.vue'))
window.Vue.component('icon-doc', require('./components/icons/IconDoc.vue'))
window.Vue.component('icon-png', require('./components/icons/IconPng.vue'))
window.Vue.component('icon-file-uploader', require('./components/icons/IconFileUploader.vue'))
window.Vue.component('csrf-token', require('./components/CsrfToken.vue'))

// place
window.Vue.component('place-form', require('./components/places/PlaceForm.vue'))
window.Vue.component('address-autocomplete', require('./components/AddressAutocomplete.vue'))
window.Vue.component('click-outside', require('./components/ClickOutside.vue'))
window.Vue.component('autosize-textarea', require('./components/AutosizeTextarea.vue'))

/* eslint-disable */
const app = new window.Vue({
    el: '#app'
})
