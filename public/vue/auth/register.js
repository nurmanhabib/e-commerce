new Vue({
    el: '#register',
    data: function() {
        return {
            activation_code: '',
            email:      '',
            password:   '',
            profile: {
                first_name:     '',
                last_name:      '',
                gender:         '',
                avatar:         '',
            },
            address: {
                address_line_1: '',
                address_line_2: '',
                phone: '',
            },
            error: '',
            message: '',
            registration_status: ''
        }
    },
    methods: {
        getActivationCode: function() {
            return this.activation_code
        },

        registerMember: function() {
            var credentials = {
                email:      this.email,
                password:   this.password,
                profile: {
                    first_name: this.profile.first_name,
                    last_name:  this.profile.last_name,
                    gender:     this.profile.gender,
                },
                address: {
                    address_line_1: this.profile.address_line_1,
                    address_line_2: this.profile.address_line_2,
                    phone:          this.profile.phone
                }
            }

            this.$http.post(API_URL + '/auth/register', credentials, (data) => {
                this.email                  = ''
                this.password               = ''
                this.profile.first_name     = ''
                this.profile.last_name      = ''
                this.profile.gender         = ''
                this.address.address_line_1 = ''
                this.address.address_line_2 = ''
                this.address.phone          = ''
            }).error((err) => {
                this.error = err.message
            })
        },

        registerOnlyEmail: function() {
            var email = {
                email: this.email
            }
            this.$http.post(API_URL + '/auth/register-email', email, (data) => {
                var link        = SITE_URL + '/register/' + data.activation_code
                var credentials = {
                    to: {
                        email: this.email,
                        name: this.email,
                    },
                    subject:    'Register Account',
                    link:       link
                }

                this.$http.post(API_URL + '/register', credentials, (data) => {
                    this.status     = data.status
                    this.message    = data.message
                    this.email      = ''

                }).error((err) => {
                    this.error = err.message
                })    

            }).error((err) => {
                this.error = err.message
            })
        },

        activateAccount: function() {
            var activation_code = this.getActivationCode()
            var credentials = {
                profile: {
                    first_name: this.profile.first_name,
                    last_name: this.profile.last_name,
                    gender: this.profile.gender
                },
                address: {
                    address_line_1: this.address.address_line_1,
                    address_line_2: this.address.address_line_2,
                    phone:          this.address.phone
                },
                password: this.password,
                activation_code: activation_code
            }
            
            this.$http.post(API_URL + '/auth/complete-registration', credentials, (data) => {
                console.log(data)
                this.registration_status    = 'success'
                this.profile.first_name     = ''
                this.profile.last_name      = ''
                this.profile.gender         = ''
                this.password               = ''
                this.activation_code        = ''
                this.address.address_line_1 = ''
                this.address.address_line_2 = ''
                this.address.phone          = ''
            }).error((err) => {
                this.error = err.message
            })
        },

        login: function() {
            window.location.assign(LOGIN_USER)
        }
    }
})