var Vue = require('vue');
var app = require('./app');
var config = require('./config');

Vue.use(require('vue-resource'));

Vue.http.options.root = config['api_root'];

new Vue(app).$mount('#app');