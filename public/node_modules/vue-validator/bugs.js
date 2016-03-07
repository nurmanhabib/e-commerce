/**
 * Import(s)
 */

var Vue = require('../../node_modules/vue/dist/vue')
var plugin = require('../../index')
var createInstance = require('./helper').createInstance


describe('bugs reporting', function () {
  var vm

  before(function () {
    Vue.use(plugin)
  })


  describe("#53: Uncaught TypeError: Cannot read property 'data' of undefined", function () {
    beforeEach(function (done) {
      vm = createInstance({
        template: '<div v-if="!content">' +
          '<button type="button" id="bug53-button1" v-on="click: onClick">Click me!</button>' +
          '</div>' +
          '<div v-if="content">' +
          '<form>' +
          '<input type="text" name="firstname" v-model="content.name" v-validate="required, minLength: 3" />' +
          '<input type="text" name="firstname" v-model="content.email" v-validate="required" />' +
          '</form>' +
          '<button type="button" id="bug53-button2" v-on="click: resetForm">Reset and back</button>' +
          '</div>',
        data: { content: null },
        methods: {
          onClick: function () {
            this.content = { name: 'John', email: 'john.doe@example.com' }
          },
          resetForm: function () {
            this.content = null
          }
        }
      }, false)

      Vue.nextTick(done)
    })

    it('should be validated', function (done) {
      document.getElementById('bug53-button1').click()
      Vue.nextTick(function () {
        document.getElementById('bug53-button2').click()
        Vue.nextTick(function () {
          document.getElementById('bug53-button1').click()
          Vue.nextTick(function () {
            expect(vm.validation.content.name.valid).to.be(true)
            expect(vm.validation.content.email.valid).to.be(true)
            done()
          })
        })
      })
    })
  })
})
