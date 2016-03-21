<template>
	<div v-show="loaded" style="display: none;">
		<slot></slot>
	</div>
</template>

<script lang="es6">
	var loading = require('./../helpers/loading.js');

	module.exports = {
		data() {
			return {
				loaded: false
			}
		},

		ready() {
			loading.setApp(this.$root);
			loading.hide();
		},

		events: {
			'loading.showing': function (timeout) {
				this.loaded = false;
			},

			'loading.hidden': function () {
				this.loaded = true;
			}
		}
	}
</script>