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

			this.$http.post(LOGIN_URL, credentials, (data) => {
		      	// Redirect to a specified route
		      	if(data.status == 'success') {
		      		// Token disimpan di localStorage 'cookies'
		        	localStorage.setItem('amtekcommerce_token', data.token)
		        	localStorage.setItem('role', 'admin')

		        	// routing bila data success login redirect ke home
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