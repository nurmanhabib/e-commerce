<style>
    
</style>

<template>
    <slot></slot>
    <ul class="navigation navigation-main navigation-accordion">
        <li class="navigation-header"><span>Dashboard</span> <i class="icon-menu" title="Main pages"></i></li>

        <li v-for="item in items" v-bind:class="{ 'active': isActive(item) }">
            <a href="{{ url(item.link) }}">
                <span>{{ item.text }}</span> <i class="{{ item.icon }}" title="{{ item.text }}"></i>
            </a>
            <ul v-if="item.childs">
                <li v-for="child in item.childs" v-bind:class="{ 'active': isActive(child) }">
                    <a href="{{ url(child.link) }}">
                        <span>{{ child.text }}</span> <i class="{{ child.icon }}" title="{{ child.text }}"></i>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script lang="es6">
    var _ = require('underscore');
    var url = require('./../helpers/url.js');

    module.exports = {
        props: {
            active: {
                type: String,
                default: '/'
            }
        },

        data() {
            return {
                items: [
                    {
                        text: 'Dashboard',
                        link: '/',
                        icon: 'icon-home4'
                    },
                    {
                        text: 'Products',
                        link: 'products',
                        icon: 'icon-cube4'
                    }
                ]
            }
        },

        methods: {
            setActive(path) {
                this.active = path;
            },

            url(path) {
                return url.to(path);
            },

            hasChilds(item) {
                var item = item || [];

                if (_.isUndefined(item.childs) === false) {
                    return _.isEmpty(item.childs) === false;
                } else {
                    return false;
                }
            },

            checkActive(items, active) {
                var that = this;
                var active = active || this.active;

                var hasActive = _.filter(items, function (item) {
                    if (that.hasChilds(item)) {
                        var hasChildActive = that.checkActive(item.childs, active);

                        if (hasChildActive) {
                            that.setItemActive(item, active);

                            return true;
                        }
                    }
                    
                    return that.isActive(item, active);
                });

                return _.size(hasActive) > 0;
            },

            isActive(item, active) {
                var active = active || this.active;

                if (url.to(item.link) == url.to(active)) {
                    this.setItemActive(item);

                    return true;
                } else {
                    return false;
                }
            },

            setItemActive(item) {
                item.active = true;
            }
        },

        ready() {
            // 
        }
    }
</script>