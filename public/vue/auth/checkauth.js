var vue = new Vue({
	el: '#checkAuth',
	methods: {
		checkAuth: function(){
			var auth = checkCookie('amtekcommerce_token')
			if (auth == false) {
				window.location.assign(LOGIN_USER)
			} else {
				console.log(auth)
			}
		}
	}
})

vue.checkAuth()