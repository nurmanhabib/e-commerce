new Vue({
    el: '#forgot-password',
    data: function() {
        return {
            email: '',
            error: '',
            status: '',
            message: ''
        }
    },
    methods: {
        forgotPassword: function() {
            var email = {
                email: this.email
            }

            this.$http.post(API_URL + '/auth/forgot-password', email, (userData) => { //ambil data forgot password
                if (userData.status == 'success') {
                    var link        = SITE_URL + '/reset-password/' + userData.remember_token
                    var credentials = {
                        to: {
                            email: this.email,
                            name: this.email,
                        },
                        subject:    'Reset Password',
                        link:       link
                    }
                    // console.log(credentials)
                    this.$http.post(API_URL + '/forgot-password', credentials, (data) => {
                        console.log(data)
                        this.status     = data.status
                        this.message    = data.message
                        this.email      = ''
                    }).error((err) => {
                        this.error = err
                        console.log(this.error)
                    })    
                } else {
                    this.status     = userData.status
                    this.message    = userData.message
                    this.email      = ''
                }
                
            }).error((err) => {
                this.error = err 
                console.log(this.error)
            })
        },
        clearMessage: function() {
            this.status     = ''
            this.message    = ''
        }       
    }
})