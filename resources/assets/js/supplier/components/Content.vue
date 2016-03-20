<template>
	<div v-show="loaded" style="display: none;">
		<slot></slot>
	</div>
</template>

<script lang="es6">
	module.exports = {
		data() {
			return {
				loaded: false
			}
		},

		ready() {
			//
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