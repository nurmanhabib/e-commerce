<style>
	
</style>

<template>
	<slot></slot>
</template>

<script lang="es6">
	module.exports = {
		props() {
			return [
				active
			]
		},
		data() {
			return {
				items: {},
				active: ''
			}
		},
		methods: {

		}
	}
</script>