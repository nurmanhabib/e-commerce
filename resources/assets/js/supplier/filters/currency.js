module.exports = function (nominal) {
	return (nominal + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}