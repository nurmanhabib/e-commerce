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
	      		this.error = err
	    	})
		},

		forgotPassword(){
			window.location.assign(FORGOT_PASSWORD)
		},

		removeAlert(){

		},
		
		checkAuth(){
			var status = localStorage.getItem('amtekcommerce_token')
			if(status !== null){
				window.location.assign(ADMIN_SITE)
			} else {
				console.log(status)
			}
		}
	}
})