module.exports = function (objects) {
	var result = '';

	for (var index in objects) { 
		if (index > 0 ) {
			result = result + ', ' + objects[index]['name'];
		} else {
			result += objects[index]['name'];
		}
	}

	return result;
}