new Vue({
	el: '#logout',
	data() {
	},
	methods: {
		logout: function() {
				var role = getCookie('role')
				if(role == 'admin'){
					clearCookies()
					window.location.assign(LOGIN_ADMIN)
				} else if(role == 'vendor'){
					clearCookies()
					window.location.assign(LOGIN_VENDOR)
				} else {
					clearCookies()
					window.location.assign(LOGIN_USER)
				}
		}		
	}
})