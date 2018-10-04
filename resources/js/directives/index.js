import Vue from 'vue'
import clickoutside from './clickOutside'
import tooltip from './tooltip'

const directives = {
  clickoutside,
  tooltip
}

Object.keys(directives).forEach(directive =>
  Vue.directive(directive, directives[directive])
)
