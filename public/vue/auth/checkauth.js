new Vue({
	el: '#checkauth',
	data() {

	},
	ready: function(){
		var auth = this.checkAuthentication()
		if(auth == false){
			window.location.assign(LOGIN_USER)
		}
	},
	methods: {
		checkAuthentication(){
			var status = localStorage.getItem('amtekcommerce_token')
			if(status !== null){
				return true
			} else {
				return false
			}
		}
	}
})