new Vue({
    el: '#register',
    data: function() {
        return {
            activation_code: null,
            register_for: '',
            email:      null,
            password:   null,
            supplier: {
                name: null,
                address1: null,
                address2: null,
                phone1: null,
                phone2: null,
                website: null,
                email: null,
                tags: null
            },
            profile: {
                first_name:     null,
                last_name:      null,
                gender:         null,
                avatar:         null,
            },
            address: {
                address_line_1: null,
                address_line_2: null,
                phone: null,
            },
            error: null,
            message: null,
            registration_status: null
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
                this.email                  = null
                this.password               = null
                this.profile.first_name     = null
                this.profile.last_name      = null
                this.profile.gender         = null
                this.address.address_line_1 = null
                this.address.address_line_2 = null
                this.address.phone          = null
            }).error((err) => {
                this.error = err.message
            })
        },

        registerOnlyEmail: function() {
            if (this.register_for == 'supplier') { //untuk menentukan link berdasarkan pendaftar
                var URL = SITE_URL + '/supplier/register/'
            } else {
                var URL = SITE_URL + '/register/'
            }

            var email = {
                email: this.email
            }

            this.$http.post(API_URL + '/auth/register-email', email, (data) => {
                var link        = URL + data.activation_code
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
                    this.email      = null

                }).error((err) => {
                    this.error = err.message
                })    

            }).error((err) => {
                this.error = err.message
            })
        },

        activateMember: function() {
            if (this.password.length >= 10) {
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
                    this.registration_status    = 'success'
                    this.profile.first_name     = null
                    this.profile.last_name      = null
                    this.profile.gender         = null
                    this.password               = null
                    this.activation_code        = null
                    this.address.address_line_1 = null
                    this.address.address_line_2 = null
                    this.address.phone          = null
                }).error((err) => {
                    this.error = err.message
                })
            } else {
                this.error = "Your password is min 10 character!"
            }
        },

        activateSupplier: function() {
            var activation_code = this.getActivationCode()
            var credentials = {
                supplier: {
                    name: this.supplier.name,
                    address_line_1: this.supplier.address1,
                    address_line_2: this.supplier.address2,
                    phone_1: this.supplier.phone1,
                    phone_2: this.supplier.phone2,
                    website: this.supplier.website,
                    email: this.supplier.email,
                    tags: this.supplier.tags
                },
                profile: {
                    first_name: this.profile.first_name,
                    last_name: this.profile.last_name,
                    gender: this.profile.gender
                },
                password: this.password,
                activation_code: activation_code
            }
            
            this.$http.post(API_URL + '/auth/complete-registration-supplier', credentials, (data) => {
                this.registration_status    = 'success'
                this.profile.first_name     = null
                this.profile.last_name      = null
                this.profile.gender         = null
                this.password               = null
                this.activation_code        = null
                this.supplier.name          = null
                this.supplier.address1      = null
                this.supplier.address2      = null
                this.supplier.phone1        = null
                this.supplier.phone2        = null
                this.supplier.website       = null
                this.supplier.email         = null
                this.supplier.tags          = null
            }).error((err) => {
                this.error = err.message
            })
        },

        login: function() {
            window.location.assign(LOGIN_USER)
        },

        loginSupplier: function() {
            window.location.assign(SITE_URL + '/supplier')
        },
    }
})