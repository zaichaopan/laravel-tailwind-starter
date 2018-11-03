
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

// Register directives
require('./directives/')

// Register components
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => {
  const name = key.split('/').pop().split('.')[0].replace(/([A-Z])/g, '-$1').substring(1).toLowerCase()
  return Vue.component(name, files(key).default || files(key))
})

/* eslint-disable */
const app = new Vue({
    el: '#app'
})
