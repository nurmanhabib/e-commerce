new Vue({
	el: '#logout',
	data() {
	},
	methods: {
		logout() {
		  	localStorage.removeItem('amtekcommerce_token')

		  	var status = localStorage.getItem('amtekcommerce_token')
			if(status == null){
				var role = localStorage.getItem('role')
				if(role == 'admin'){
					localStorage.removeItem('role')
					window.location.assign(LOGIN_ADMIN)
				} else if(role == 'vendor'){
					localStorage.removeItem('role')
					window.location.assign(LOGIN_VENDOR)
				} else {
					localStorage.removeItem('role')
					window.location.assign(LOGIN_USER)
				}
				// console.log(status)
			} else {
				console.log(status)
			}
		}		
	}
})