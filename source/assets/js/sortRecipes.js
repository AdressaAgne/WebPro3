// @codekit-prepend "prototype.js"
var checkboxes = document.querySelectorAll('[type=checkbox]');

for(var i = 0; i < checkboxes.length; i++){
	var checkbox = checkboxes[i];

	checkbox.addEventListener('change', function(event) {
		var dataList = {
			'_token' 	: elm('[name=_token]').value,
			'_method' 	: 'POST',
		};

		var boxes = document.querySelectorAll('[type=checkbox]:checked');
		var checkboxid = [];

		for(var j = 0;j < boxes.length; j++){
			dataList['id['+j+']'] = boxes[j].value;
		}

		ajax('recipes/sorting', dataList, function(data) {
			//console.log(data);

			elm('#recipes').innerHTML = data;


		});

	});

}
