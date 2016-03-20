<style>

</style>

<template>
    <div v-show="loading">
        <slot>Loading ...</slot>
    </div>
</template>

<script lang="es6">
    module.exports = {
        data() {
            return {
                loading: true
            }
        },

        methods: {
            show(timeout) {
                var timeout = timeout || 0;

                this.$parent.$broadcast('loading.showing');

                this.loading = true;

                if (timeout > 0) {
                    setTimeout(function() {
                        that.hide();
                    }, timeout);
                }
            },

            hide() {
                this.loading = false;

                this.$parent.$broadcast('loading.hidden');
            }
        },

        ready() {
            // 
        },

        events: {
            'loading.show': function (timeout) {
                this.show(timeout);
            },

            'loading.hide': function () {
                this.hide();
            }
        }
    }
</script>