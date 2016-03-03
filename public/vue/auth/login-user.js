new Vue({
	el: '#login',
	
	data(){
		return {
			credentials: {
				email: '',
				password: '',
				remember: ''
			},
			error: ''
		}
	},
	ready: function(){
		this.checkAuth()
	},
	methods: {
		loginUser: function() {
			if (this.credentials.email !== '' || this.credentials.password !== '') {
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
			        	setCookie('amtekcommerce_token', data.token, expiredDays)
			        	setCookie('role', data.user.roles[0].slug, expiredDays)
			        	// routing bila data success login redirect
			        	window.location.assign(ADMIN_SITE)
			      	} else {
			          	// alert notifikasi failed login
			          	this.status = data.status
			          	this.error = data.message
			          	console.log(this.error)
			      	}

		    	}).error((err) => {
		      		this.error = err.message
		    	})
			} else {
				this.status = 'failed'
				this.error = 'Username and password is required'
			}
		},
		
		checkAuth: function() {
			var status = localStorage.getItem('amtekcommerce_token')
			if(status !== null){
				window.location.assign(ADMIN_SITE)
			} else {
				console.log(status)
			}
		},

		forgotPassword: function() {
			window.location.assign(FORGOT_PASSWORD)
		},

		clearError: function() {
			this.error = ''
		},

		signUp: function() {
			window.location.assign(SITE_URL + '/register')
		}
	}
})