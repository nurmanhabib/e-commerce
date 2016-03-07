var config = require('./config');
var STORAGE_KEY = config.storage_key;

module.exports = {
	todoStorage: {
		fetch() {
			return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
		},
		save(todos) {
			localStorage.setItem(STORAGE_KEY, JSON.stringify(todos));
		}
	}
}