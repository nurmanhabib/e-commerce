window.fbAsyncInit = function() {
    //SDK loaded, initialize it
    FB.init({
        appId      : '229927090688662',
        xfbml      : true,
        version    : 'v2.5'
    });
};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

Vue.component('social-facebook', {
    methods: {
        handle: function () {
            this.check();
        },
        register: function (data) {
            var credentials = {
                email: data.email,
                profile: {
                    first_name: data.first_name,
                    last_name: data.last_name
                },
                activated: data.verified
            };

            this.$http.post(SIGNUP_URL, credentials, function (response) {
                if (response.status == 'success') {
                    // Token disimpan di localStorage 'cookies'
                    var expiredDays = 30;

                    setCookie('remember', remember, expiredDays);
                    setCookie('amtekcommerce_token', data.token, expiredDays);

                    // routing bila data success login redirect ke home
                    window.location.assign(ADMIN_SITE)
                } else {

                }
            }).error(function (response) {
                console.log(response)
            })
        },
        login: function (id) {

        },
        action: function () {
            var that = this

            FB.api('/me', {fields: ['name', 'email', 'first_name', 'last_name', 'gender', 'verified']}, function(response) {
                console.log(JSON.stringify(response));

                that.register(response)
            });
        },
        check: function () {
            var that = this;

            FB.login(function(response) {
                that.response(response);
            });
        },
        response: function (response) {
            if (response.authResponse) {
                this.action();
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }
    },
    events: {
        'social-auth': function (driver) {
            if (driver == 'facebook') {
                this.handle();
            }
        }
    }
})
