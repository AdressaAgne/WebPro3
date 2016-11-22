// @codekit-prepend "prototype.js"

ajax('species/sort', {
	_token : elm('[name=_token]').value,
	_method : 'POST',
	
}, function(data) {
	console.log(data);
});

