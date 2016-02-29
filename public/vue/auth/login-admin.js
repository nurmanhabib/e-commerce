new Vue({
	el: '#login',
	
	data(){
		return {
			credentials: {
				email: '',
				password: ''
			},
			error: ''
		}
	},
	ready: function(){
		this.checkAuth()
	},
	methods: {
		loginAdmin(){
			var credentials = {
				email: this.credentials.email,
				password: this.credentials.password
			}

			var remember = this.credentials.remember

			this.$http.post(LOGIN_URL, credentials, (data) => {
		      	// Redirect to a specified route
		      	if(data.status == 'success') {
		      		// Token disimpan di localStorage 'cookies'
		        	var expiredDays = 30
		        	setCookie('remember', remember, expiredDays)
		        	setCookie('amtekcommerce_token', data.token)
		        	setCookie('role', data.user.roles[0].slug)

		        	console.log(getCookie('remember'))
		        	console.log(getCookie('amtekcommerce_token'))
		        	console.log(getCookie('role'))

		        	// routing bila data success login redirect ke home
		        	window.location.assign(ADMIN_SITE)
		      	} else {
		          	// alert notifikasi failed login
		          	this.status = data.status
		          	this.error = data.message
		          	console.log(data)
		      	}

	    	}).error((err) => {
	      		this.error = err
	    	})
		},
		removeAlert(){

		},
		checkAuth(){
			var token = getCookie('amtekcommerce_token')
			if(token !== ''){
				window.location.assign(ADMIN_SITE)
			} else {
				clearCookie()
				console.log(status)
			}
		}
	}
})