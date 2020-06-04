
function getItems(){

	console.log('function');

	let page = location.hash;
	page = page.replace('#', '');

	$.ajax({
		type: 'GET',
		url:  'ajax.php?',
		data: {
			'action': 'getItems',
			'page':   page
		},
		beforeSend: function(){
			// Show loading
			$('.loading').append('loading');
		},
		success: function(result){
			console.log(result);
			// Hide loading
			$('.loading').empty();
		},
		error: function(){
			console.log('error');
		}
	});
}

$(document).ready( function(){
	// Call functions
	console.log('ready');
	getItems();
});
