// util
var _ = {
  warn: function (err, msg) {
    if (window.console) {
      console.warn('[vue-validator] ' + msg)
      if (err) {
        console.warn(err.stack)
      }
    }
  }
}

// mixin
var mixin = {
  created: function () {
    this._validations = {}
  },
  beforeDestroy: function () {
    // TODO: teardown _validations
    //
  }
}

function installer (Vue) {
  var util = Vue.util

  /*
  var component = Vue.directive('_component')
  var bind = component.bind
  component.bind = function () {
    bind.call(this)
    this.template = util.extractContent(this.el, true)
  }
  Vue.directive('_component', component)
  */

  Vue.component('validator', {
    inherit: true,
    template: '<content></content>',
    data: function () {
      return { validation: {} }
    }
  })
}




Vue.use(installer)

var vm = new Vue({
  data: {
    msg: 'hello',
    foo: 1,
  }
})
vm.$mount('#app')
