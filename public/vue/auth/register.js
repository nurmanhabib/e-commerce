new Vue({
    el: '#register',
    data: function() {
        return {
            username:   '',
            email:      '',
            password:   '',
            profile: {
                first_name:     '',
                last_name:      '',
                gender:         '',
                avatar:         ''
            },
            error: '',
            message: ''
        }
    },
    methods: {
        registerMember: function() {
            var credentials = {
                username:   this.username,
                email:      this.email,
                password:   this.password,
                profile: {
                    first_name: this.profile.first_name,
                    last_name:  this.profile.last_name,
                    gender:     this.profile.gender,
                    avatar:     this.profile.avatar 
                }
            }

            this.$http.post(API_URL + '/auth/register', credentials, (data) => {
                console.log(data)
            }).error((err) => {
                this.error = err
            })
        }
    }
})