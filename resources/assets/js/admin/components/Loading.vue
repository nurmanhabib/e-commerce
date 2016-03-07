<style>

</style>

<template>
    <div v-show="show">
        <slot>Loading ...</slot>
    </div>
</template>

<script lang="es6">
    module.exports = {
        data() {
            return {
                show: true
            }
        },

        methods: {
            showing(data) {
                var timeout = data.timeout;

                this.show = true;
                this.$parent.$broadcast('loading');

                if (typeof timeout !== 'undefined') {
                    var that = this;

                    setTimeout(function() {
                        that.hide();
                    }, timeout);
                }
            },
            hide() {
                this.show = false;
                this.$parent.$broadcast('loaded');
            }
        },

        ready() {
            // 
        },

        events: {
            'loading.show': function (timeout) {
                this.showing(timeout);
            },
            'loading.hide': function () {
                this.hide();
            }
        }
    }
</script>