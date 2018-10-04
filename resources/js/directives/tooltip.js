import PopperTooltip from 'tooltip.js'

const directive = {}

directive.bind = function (elem, bindings) {
  new PopperTooltip(elem, {// eslint-disable-line no-new
    placement: bindings.arg || 'top',
    title: bindings.value
  })
}

export default directive
