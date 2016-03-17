// URL and endpoint constants
const API_URL = 'http://192.168.1.17:8000/api/v1'
const SITE_URL = 'http://192.168.1.17:8000'

// API Endpoint
const LOGIN_URL = API_URL + '/auth/credentials'
const SIGNUP_URL = API_URL + '/register'

// Link SITE
const LOGIN_USER = SITE_URL + '/login'
const LOGIN_ADMIN = SITE_URL + '/admin'
const LOGIN_SUPPLIER = SITE_URL + '/supplier'
const FORGOT_PASSWORD = SITE_URL + '/forgot-password'

//Admin
const SHOW_PARENTS = API_URL + '/categories'

const ADMIN_SITE = SITE_URL + '/admin/dashboard'



//Set header token
Vue.http.headers.common['Authorization'] = 'Bearer ' + getCookie('amtekcommerce_token');
