var Vue = require('vue');
var app = require('./app');
var config = require('./config');

Vue.use(require('vue-resource'));

Vue.http.options.root = config['API_URL'];

new Vue(app).$mount('#app');