module.exports = {
    set(key, value, exdays, path) {
        var prefix = 'amtekcommerce_';
        var cname = prefix + key;
        var exdays = exdays || 30;
        var path = path || '/';
        var d = new Date();

        d.setTime(d.getTime() + (exdays*24*60*60*1000));

        var expires = d.toUTCString();

        document.cookie = cname + '=' + value + '; expires=' + expires + '; path=' + path;
    },

    get(key) {
        var prefix = 'amtekcommerce_';
        var name = prefix + key + "=";
        var ca = document.cookie.split(';');

        for (var i=0; i<ca.length; i++) {
            var c = ca[i];

            while (c.charAt(0) == ' ')
                c = c.substring(1);

            if (c.indexOf(name) == 0)
                return c.substring(name.length, c.length);
        }

        return '';
    },

    has(key) {
        var cookie = this.get(key);

        if (cookie != '') {
            return true;
        } else {
            return false;
        }
    },

    forget(key) {
        this.set(key, '', -1);
    },

    flush() {
        var cookies = document.cookie.split(';');
        
        for (var i = 0; i < cookies.length; i++) {
            this.forget(cookies[i].split('=')[0]);
        }
    }
}