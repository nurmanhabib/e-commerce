var Vue = require('vue');
var app = require('./app');

Vue.use(require('vue-resource'));

new Vue(app).$mount('#app');