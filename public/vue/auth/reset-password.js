new Vue({
    el: '#reset-password',
    data: function() {
        return {
            email: '',
            password: '',
            password_confirmation: '',
            status: '',
            message: ''
        }
    },
    ready: function() {
        console.log(this.getToken())
    },
    methods: {
        getToken: function() {
            var url = window.location.href;
            //get rid of the trailing / before doing a simple split on /
            var url_parts = url.replace(/\/\s*$/,'').split('/'); 

            return url_parts[4]
        },
        resetPassword: function() {
            var token   = this.getToken()
            var credentials = {
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                remember_token: token
            }

            console.log(credentials)

            this.$http.post(API_URL + '/auth/reset-password', credentials, (data) => {
                console.log(data)
                if (data.status == 'success') {
                    window.location.assign(LOGIN_USER)
                } else {
                    this.status     = data.status
                    this.message    = data.message
                }
            }).error((err) => {
                console.log(err)
                this.message = err.message
            })
        },
        clearMessage: function() {
            this.status     = ''
            this.message    = ''
        }        
    }
})
