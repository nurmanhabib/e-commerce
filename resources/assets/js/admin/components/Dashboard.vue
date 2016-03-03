<style>
	
</style>

<template>
	<slot>Message from dashboard: {{ message }}</slot>
</template>

<script lang="es6">
	module.exports = {
		data() {
			return {
				message: 'Hello World!'
			}
		}
	}
</script>