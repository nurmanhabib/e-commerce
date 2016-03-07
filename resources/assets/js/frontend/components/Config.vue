<script lang="es6">
    var store = require('./../store');
    var config = require('./../config');

    module.exports = {
        data() {
            return {
                config: null,
                loaded: false
            }
        },
        watch: {
            config: {
                deep: true,
                handler: store.save
            }
        },
        methods: {
            get(name) {
                if (this.config.hasOwnProperty(name))
                    return this.config[name];
                else
                    return null;
            },
            set(name, value) {
                this.config[name] = value;
            }
        },
        ready() {
            store.fetch();

            if (this.config != null) {
                this.loaded = true;
            } else {
                this.loaded = false;
            }

            if (!this.loaded) {
                this.config = config;
                this.loaded = true;
            }
        }     
    }
</script>