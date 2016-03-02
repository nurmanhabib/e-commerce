<template>
	<div v-show="loaded" style="display: none;">
		<slot></slot>
	</div>
</template>

<script lang="es6">
	var Dashboard = require('./Dashboard.vue');
	var Supplier = require('./Supplier.vue');

	module.exports = {
		components: {
			'dashboard': Dashboard,
			'supplier': Supplier
		},

		data() {
			return {
				loaded: false
			}
		},

		ready() {
			//
		},

		events: {
			'loaded': function () {
				this.loaded = true;
			}
		}
	}
</script>