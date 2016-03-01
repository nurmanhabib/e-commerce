new Vue({
	el: '#login',
	
	data(){
		return {
			credentials: {
				email: ''
			},
			error: ''
		}
	},
	ready: function(){
		this.checkAuth()
	},
	methods: {
		loginUser(){
			var credentials = {
				email: this.credentials.email
			}

			this.$http.post(LOGIN_URL, credentials, (data) => {
		      	// Redirect to a specified route
		      	if(data.status == 'success') {
		      		// Token disimpan di localStorage 'cookies'
		        	localStorage.setItem('amtekcommerce_token', data.token)
		        	localStorage.setItem('role', 'user')
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

			}
		},

		social(driver) {
			this.$broadcast('social-auth', driver);
		}
	}
})