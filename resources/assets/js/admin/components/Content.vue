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

		events: {
			'loaded': function () {
				this.loaded = true;
			}
		}
	}
</script>